<?php
namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{

    public function index(Request $request)
    {
       
        $portfolios = $request->user()->portfolios;
        return view('portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('portfolio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'template' => 'nullable|string|max:255',
        ]);

        $portfolio = Portfolio::create([
            'user_id' => $request->user()->id, 
            'title' => $validated['title'] ?? null,
            'template' => $validated['template'] ?? 'default',
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio created successfully');
    }

    public function show($id)
    {
        $portfolio = Portfolio::with(['skills', 'education', 'experience', 'aboutMe'])->findOrFail($id);
        $template = $portfolio->template ?? 'default';
        return view("portfolio_templates.$template", compact('portfolio'));
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $portfolio->update($request->only(['title', 'template']));

        return redirect()->route('portfolios.index')->with('success', 'Portfolio updated');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if (auth()->id() !== $portfolio->user_id) {
            abort(403, 'Unauthorized');
        }

        $portfolio->delete();

        return redirect()->route('portfolios.index')->with('success', 'Portfolio deleted');
    }
}
