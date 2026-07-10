<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = FileSubmission::with('service')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('customer_name','like','%'.$request->search.'%')
                  ->orWhere('phone','like','%'.$request->search.'%')
                  ->orWhere('chassis_no','like','%'.$request->search.'%');
            });
        }

        $submissions = $query->paginate(15);
        return view('admin.file-submissions.index', compact('submissions'));
    }

    public function show(FileSubmission $fileSubmission)
    {
        $fileSubmission->load('service');
        return view('admin.file-submissions.show', compact('fileSubmission'));
    }

    public function updateStatus(Request $request, FileSubmission $fileSubmission)
    {
        $request->validate(['status' => 'required|in:new,reviewing,completed,rejected']);
        $fileSubmission->update(['status' => $request->status]);
        return back()->with('success', 'Status updated.');
    }

    public function download(FileSubmission $fileSubmission)
    {
        if (!Storage::disk('public')->exists($fileSubmission->file_path)) {
            abort(404, 'File not found.');
        }
        return Storage::disk('public')->download(
            $fileSubmission->file_path,
            $fileSubmission->original_filename
        );
    }

    public function destroy(FileSubmission $fileSubmission)
    {
        Storage::disk('public')->delete($fileSubmission->file_path);
        $fileSubmission->delete();
        return redirect()->route('admin.file-submissions.index')->with('success', 'Submission deleted.');
    }
}
