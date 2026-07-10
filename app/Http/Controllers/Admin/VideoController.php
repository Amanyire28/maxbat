<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->paginate(15);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $video = new Video();
        return view('admin.videos.form', compact('video'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'video_url'   => 'required|url|max:500',
            'description' => 'nullable|string',
            'category'    => 'nullable|string|max:100',
        ]);

        $data['active'] = $request->has('active');

        Video::create($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video created successfully.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.form', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'video_url'   => 'required|url|max:500',
            'description' => 'nullable|string',
            'category'    => 'nullable|string|max:100',
        ]);

        $data['active'] = $request->has('active');

        $video->update($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')
            ->with('success', 'Video deleted successfully.');
    }
}
