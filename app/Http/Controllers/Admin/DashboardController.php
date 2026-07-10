<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'inquiries'         => Inquiry::count(),
            'new_inquiries'     => Inquiry::where('status', 'new')->count(),
            'products'          => Product::count(),
            'services'          => Service::count(),
            'file_submissions'  => \App\Models\FileSubmission::count(),
            'new_files'         => \App\Models\FileSubmission::where('status','new')->count(),
        ];
        $recent_inquiries = Inquiry::latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'recent_inquiries'));
    }
}
