<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use Illuminate\Http\Request;

class AboutMeController extends Controller
{
    public function index($portfolioId)
    {
        $aboutMe = AboutMe::where('portfolio_id', $portfolioId)->get();
        return response()->json($aboutMe);
    }

    public function store(Request $request, $portfolioId)
    {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        $aboutMe = AboutMe::create([
            'portfolio_id' => $portfolioId,
            'description' => $validated['description'],
        ]);

        return redirect()->route('portfolios.index')->with('success', 'About Me added successfully');
    }

    public function show($portfolioId, $id)
    {
        $aboutMe = AboutMe::where('portfolio_id', $portfolioId)->findOrFail($id);
        return response()->json($aboutMe);
    }

    public function update(Request $request, $portfolioId, $id)
    {
        $aboutMe = AboutMe::where('portfolio_id', $portfolioId)->findOrFail($id);

        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        $aboutMe->update($validated);

        return redirect()->route('portfolios.index')->with('success', 'About Me updated successfully');
    }

    public function destroy($portfolioId, $id)
    {
        $aboutMe = AboutMe::where('portfolio_id', $portfolioId)->findOrFail($id);
        $aboutMe->delete();

        return response()->json(['message' => 'About Me deleted successfully']);
    }
}
