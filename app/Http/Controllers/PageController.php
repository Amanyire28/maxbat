<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $services = \App\Models\Service::where('active', true)->orderBy('sort_order')->take(4)->get();
        return view('pages.home', compact('services'));
    }
    public function services()
    {
        $services = \App\Models\Service::where('active', true)->orderBy('sort_order')->get();
        return view('pages.services', compact('services'));
    }
    public function products()
    {
        $products = \App\Models\Product::where('active', true)->latest()->get();
        return view('pages.products', compact('products'));
    }
    public function projects(){ return view('pages.projects'); }
    public function about()   { return view('pages.about'); }
    public function blog()    { return view('pages.blog'); }
    public function contact() { return view('pages.contact'); }

    public function submitContact(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:30',
            'email'         => 'nullable|email|max:255',
            'vehicleMake'   => 'nullable|string|max:100',
            'vehicleModel'  => 'nullable|string|max:100',
            'service'       => 'nullable|string|max:255',
            'message'       => 'nullable|string|max:2000',
        ]);

        Inquiry::create([
            'name'          => $data['name'],
            'phone'         => $data['phone'],
            'email'         => $data['email'] ?? null,
            'vehicle_make'  => $data['vehicleMake'] ?? null,
            'vehicle_model' => $data['vehicleModel'] ?? null,
            'service'       => $data['service'] ?? null,
            'message'       => $data['message'] ?? null,
            'status'        => 'new',
        ]);

        return redirect()->route('contact')->with('success', "Thank you {$data['name']}! We'll be in touch within 24 hours.");
    }
}
