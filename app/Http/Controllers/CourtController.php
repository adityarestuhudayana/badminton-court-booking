<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courts = Court::latest()->get();

        return view('dashboard.courts', [
            'courts' => $courts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.courts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedRequests = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $validatedRequests['image_url'] = $request->file('image')->store('court_images');

        $court = Court::create($validatedRequests);

        $court->schedules()->attach(Schedule::all()->pluck('id'));

        return redirect('/dashboard/courts')->with('add-court', 'Court baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $court = Court::findOrFail($id);

        return view('dashboard.courts.edit', ['court' => $court]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $court = Court::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image jika di-upload baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama kalau ada
            if ($court->image_url && Storage::disk('public')->exists($court->image_url)) {
                Storage::disk('public')->delete($court->image_url);
            }

            // Simpan gambar baru
            $path = $request->file('image')->store('court_images');
            $validated['image_url'] = $path;
        } else {
            // Kalau tidak upload baru, pakai image_url lama
            $validated['image_url'] = $request->input('image_url');
        }

        $court->update($validated);

        return redirect('/dashboard/courts')->with('update-court', 'Court berhasil diubah!.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $court = Court::findOrFail($id);
        Storage::disk('public')->delete($court->image_url);
        $court->delete();

        return redirect('/dashboard/courts')->with('delete-court', 'Court berhasil dihapus.');
    }
}
