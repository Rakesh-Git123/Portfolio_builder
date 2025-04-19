<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{

    public function index($portfolioId)
    {
        $experiences = Experience::where('portfolio_id', $portfolioId)->get();
        return response()->json($experiences);
    }

    public function store(Request $request, $portfolioId)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $experience = Experience::create([
            'portfolio_id' => $portfolioId,
            'position' => $validated['position'],
            'company' => $validated['company'],
            'duration' => $validated['duration'],
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Experience added successfully');
    }

    public function show($portfolioId, $id)
    {
        $experience = Experience::where('portfolio_id', $portfolioId)->findOrFail($id);
        return response()->json($experience);
    }

    public function update(Request $request, $portfolioId, $id)
    {
        $experience = Experience::where('portfolio_id', $portfolioId)->findOrFail($id);

        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $experience->update($validated);

        return response()->json([
            'message' => 'Experience updated successfully',
            'experience' => $experience
        ]);
    }

    public function destroy($portfolioId, $id)
    {
        $experience = Experience::where('portfolio_id', $portfolioId)->findOrFail($id);
        $experience->delete();

        return redirect()->back()->with('success', 'Experience deleted successfully');
    }
}
