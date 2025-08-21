<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionsController extends Controller
{
    public function index()
    {
        $sections = Section::all(); // Get all sections, not just 5
        $totalSections = Section::count();
        $topParentSections = Section::whereNull('parent')->orderByDesc('id')->limit(5)->get();

    return view('sections', compact('sections', 'totalSections', 'topParentSections'));
    }


public function store(Request $request)
{
    $request->validate([
        'section' => 'required|string|max:255',
        'parent_id' => 'nullable|integer',
    ]);

    // Check depth limit on server side as well
    if ($request->parent_id && $request->parent_id != 0) {
        $parentSection = Section::find($request->parent_id);
        if ($parentSection) {
            $depth = $this->calculateDepth($parentSection);

            if ($depth >= 3) {
                return redirect()->back()->with('error', 'Cannot create sections deeper than 4 levels. Great grandchildren are the maximum depth allowed.');
            }
        }
    }

    // Convert parent_id to appropriate value for database
    $parentValue = ($request->parent_id && $request->parent_id != 0) ? $request->parent_id : 0;

    Section::create([
        'section' => $request->section,
        'parent' => $parentValue,
    ]);

    return redirect()->back()->with('success', 'Section added successfully!');
}

private function calculateDepth($section, $depth = 0)
    {
        if (!$section || $section->parent == 0) {
            return $depth;
        }

        $parentSection = Section::find($section->parent);
        return $this->calculateDepth($parentSection, $depth + 1);
    }
}
