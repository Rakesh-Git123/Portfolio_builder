<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index($portfolioId)
    {
        $skills = Skill::where('portfolio_id', $portfolioId)->get();
        return response()->json($skills);
    }

    public function create() {}

    public function store(Request $request, $portfolioId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            
        ]);

        $skill = Skill::create([
            'portfolio_id' => $portfolioId,
            'name' => $validated['name'],
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Skill added successfully');
    }

    public function show($portfolioId, $id)
    {
        $skill = Skill::where('portfolio_id', $portfolioId)->findOrFail($id);
        return response()->json($skill);
    }

    public function edit($portfolioId, $id) {}


    public function update(Request $request, $portfolioId, $id)
    {
        $skill = Skill::where('portfolio_id', $portfolioId)->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',

        ]);

        $skill->update($validated);

        return response()->json([
            'message' => 'Skill updated successfully',
            'skill' => $skill
        ]);
    }


    public function destroy($portfolioId, $id)
    {
        $skill = Skill::where('portfolio_id', $portfolioId)->findOrFail($id);
        $skill->delete();

        return redirect()->back()->with('success', 'Skill deleted successfully');
    }
}
