<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index($portfolioId)
    {
        $education = Education::where('portfolio_id', $portfolioId)->get();
        return response()->json($education);
    }

    public function store(Request $request, $portfolioId)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'year' => 'required|string|max:50',
        ]);

        $education = Education::create([
            'portfolio_id' => $portfolioId,
            'degree' => $validated['degree'],
            'institution' => $validated['institution'],
            'year' => $validated['year'],
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Education created successfully');
    }

    public function show($portfolioId, $id)
    {
        $education = Education::where('portfolio_id', $portfolioId)->findOrFail($id);
        return response()->json($education);
    }

    public function update(Request $request, $portfolioId, $id)
    {
        $education = Education::where('portfolio_id', $portfolioId)->findOrFail($id);

        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'year' => 'required|string|max:50',
        ]);

        $education->update($validated);

        return response()->json([
            'message' => 'Education updated successfully',
            'education' => $education
        ]);
    }

    public function destroy($portfolioId, $id)
    {
        $education = Education::where('portfolio_id', $portfolioId)->findOrFail($id);
        $education->delete();

        return redirect()->back()->with('success', 'Education deleted successfully!');
    }
}
