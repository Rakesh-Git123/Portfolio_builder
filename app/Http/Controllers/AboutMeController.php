<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $imagePath = null;

        
        if ($request->hasFile('image')) {
          
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/about'), $imageName);
            $imagePath = 'uploads/about/' . $imageName; 
        }

        AboutMe::create([
            'portfolio_id' => $portfolioId,
            'description' => $validated['description'],
            'image' => $imagePath,
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('image')) {
           
            if ($aboutMe->image && file_exists(public_path($aboutMe->image))) {
                unlink(public_path($aboutMe->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/about'), $imageName);
            $aboutMe->image = 'uploads/about/' . $imageName; 
        }

      
        $aboutMe->description = $validated['description'];
        $aboutMe->save();

        return redirect()->route('portfolios.index')->with('success', 'About Me updated successfully');
    }

    public function destroy($portfolioId, $id)
    {
    
        $aboutMe = AboutMe::where('portfolio_id', $portfolioId)->findOrFail($id);

        if ($aboutMe->image && file_exists(public_path($aboutMe->image))) {
            unlink(public_path($aboutMe->image));
        }

        $aboutMe->delete();

        return response()->json(['message' => 'About Me deleted successfully']);
    }
}
