<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function store(Request $request, $portfolioId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $portfolio = Portfolio::findOrFail($portfolioId);

        $portfolio->projects()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Project added successfully!');
    }

    public function edit($portfolioId, $id)
    {
        $project = Project::where('portfolio_id', $portfolioId)->findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $portfolioId, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = Project::where('portfolio_id', $portfolioId)->findOrFail($id);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Project updated successfully!');
    }

    public function destroy($portfolioId, $id)
    {
        $project = Project::where('portfolio_id', $portfolioId)->findOrFail($id);
        $project->delete();

        return redirect()->back()->with('success', 'Project deleted successfully!');
    }
}
