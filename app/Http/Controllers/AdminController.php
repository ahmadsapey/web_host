<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeContent;

class AdminController extends Controller
{
    public function index()
    {
        $homeContent = HomeContent::first() ?? new HomeContent();
        return view('admin.home', compact('homeContent'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $homeContent = HomeContent::first();
        if (!$homeContent) {
            $homeContent = new HomeContent();
        }

        $homeContent->title = $request->title;
        $homeContent->subtitle = $request->subtitle;
        $homeContent->content = $request->content;

        if ($request->hasFile('poster_image')) {
            $imagePath = $request->file('poster_image')->store('posters', 'public');
            $homeContent->poster_image = $imagePath;
        }

        $homeContent->save();

        return redirect()->route('admin.home')->with('success', 'Konten home berhasil diperbarui.');
    }
}
