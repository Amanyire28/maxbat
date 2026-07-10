<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarForSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarForSaleController extends Controller
{
    public function index()
    {
        $cars = CarForSale::latest()->paginate(15);
        return view('admin.cars-for-sale.index', compact('cars'));
    }

    public function create()
    {
        $car = new CarForSale();
        return view('admin.cars-for-sale.form', compact('car'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'make'          => 'required|string|max:100',
            'model'         => 'required|string|max:100',
            'year'          => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price'         => 'required|numeric|min:0',
            'mileage'       => 'required|integer|min:0',
            'transmission'  => 'required|string|max:50',
            'fuel_type'     => 'required|string|max:50',
            'engine_size'   => 'nullable|string|max:50',
            'color'         => 'nullable|string|max:50',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|max:3072',
            'gallery.*'     => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if ($file->isValid()) {
                    $galleryPaths[] = $file->store('cars/gallery', 'public');
                }
            }
        }
        $data['gallery'] = $galleryPaths;
        $data['active']  = $request->has('active');

        CarForSale::create($data);

        return redirect()->route('admin.cars-for-sale.index')
            ->with('success', 'Car listing created successfully.');
    }

    public function edit($id)
    {
        $car = CarForSale::findOrFail($id);
        return view('admin.cars-for-sale.form', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $car = CarForSale::findOrFail($id);
        $data = $request->validate([
            'make'          => 'required|string|max:100',
            'model'         => 'required|string|max:100',
            'year'          => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price'         => 'required|numeric|min:0',
            'mileage'       => 'required|integer|min:0',
            'transmission'  => 'required|string|max:50',
            'fuel_type'     => 'required|string|max:50',
            'engine_size'   => 'nullable|string|max:50',
            'color'         => 'nullable|string|max:50',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|max:3072',
            'gallery.*'     => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        $galleryPaths = $car->gallery ?? [];
        
        if ($request->hasFile('gallery')) {
            if ($request->boolean('replace_gallery', false)) {
                foreach ($galleryPaths as $oldPath) {
                    Storage::disk('public')->delete($oldPath);
                }
                $galleryPaths = [];
            }
            
            foreach ($request->file('gallery') as $file) {
                if ($file->isValid()) {
                    $galleryPaths[] = $file->store('cars/gallery', 'public');
                }
            }
        }
        
        if ($request->has('remove_gallery_images')) {
            $removeImages = $request->input('remove_gallery_images');
            foreach ($removeImages as $removePath) {
                Storage::disk('public')->delete($removePath);
                $galleryPaths = array_values(array_filter($galleryPaths, function($path) use ($removePath) {
                    return $path !== $removePath;
                }));
            }
        }

        $data['gallery'] = $galleryPaths;
        $data['active']  = $request->has('active');

        $car->update($data);

        return redirect()->route('admin.cars-for-sale.index')
            ->with('success', 'Car listing updated successfully.');
    }

    public function destroy($id)
    {
        $car = CarForSale::findOrFail($id);
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        if (is_array($car->gallery)) {
            foreach ($car->gallery as $oldPath) {
                Storage::disk('public')->delete($oldPath);
            }
        }
        $car->delete();

        return redirect()->route('admin.cars-for-sale.index')
            ->with('success', 'Car listing deleted successfully.');
    }
}
