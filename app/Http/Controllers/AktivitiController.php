<?php

namespace App\Http\Controllers;

use App\Models\Aktiviti;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AktivitiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aktivitis = Aktiviti::all();

        $upcomingAktivitis = Aktiviti::where('tarikh_aktiviti', '>=', today())
            ->orderBy('tarikh_aktiviti')
            ->orderBy('masa_aktiviti')
            ->get();

        $pastAktivitis = Aktiviti::where('tarikh_aktiviti', '<', today())
            ->orderByDesc('tarikh_aktiviti')
            ->orderByDesc('masa_aktiviti')
            ->get();

        return view('Berita.Aktiviti.aktiviti', [
            'aktivitis' => $aktivitis,
            'upcomingAktivitis' => $upcomingAktivitis,
            'pastAktivitis' => $pastAktivitis,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Berita.Aktiviti.tambah_aktiviti');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'tajuk_aktiviti' => 'required',
            'gambar_aktiviti' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tarikh_aktiviti' => 'required|date',
            'masa_aktiviti' => 'required',
            'tempat_aktiviti' => 'required',
            'deskripsi_aktiviti' => 'required',
        ]);

        if ($request->hasFile('gambar_aktiviti')) {
            $image = $request->file('gambar_aktiviti');
            $name = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/aktiviti');
            $image->move($destinationPath, $name);
            $incomingFields['gambar_aktiviti'] = $name;
        }

        //This is a security measure to prevent Cross-Site Scripting (XSS) attacks, which are a common attack vector for malicious users.
        $incomingFields['tajuk_aktiviti'] = strip_tags($incomingFields['tajuk_aktiviti']);
        $incomingFields['gambar_aktiviti'] = strip_tags($incomingFields['gambar_aktiviti']);
        $incomingFields['tarikh_aktiviti'] = strip_tags($incomingFields['tarikh_aktiviti']);
        $incomingFields['masa_aktiviti'] = strip_tags($incomingFields['masa_aktiviti']);
        $incomingFields['tempat_aktiviti'] = strip_tags($incomingFields['tempat_aktiviti']);
        $incomingFields['deskripsi_aktiviti'] = strip_tags($incomingFields['deskripsi_aktiviti']);
        $incomingFields['user_id'] = auth()->id();

        Aktiviti::create($incomingFields);

        return redirect()->route('aktiviti.index')->with('success', 'Aktiviti berjaya ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aktiviti $aktiviti)
    {
        return view('Berita.Aktiviti.lihat_aktiviti', [
            'aktiviti' => $aktiviti,
        ]);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        // Implement your search logic here, e.g., using Eloquent
        $searchResults = Aktiviti::where('tajuk_aktiviti', 'like', "%$searchQuery%")
            ->orWhere('tempat_aktiviti', 'like', "%$searchQuery%")
            ->orWhere('deskripsi_aktiviti', 'like', "%$searchQuery%")
            ->get();

        return view('Berita.Aktiviti.search_results', ['searchResults' => $searchResults]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aktiviti $aktiviti)
    {
        return view('Berita.Aktiviti.tambah_aktiviti', [
            'aktiviti' => $aktiviti,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aktiviti $aktiviti)
    {
        $incomingFields = $request->validate([
            'tajuk_aktiviti' => 'required',
            'gambar_aktiviti' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tarikh_aktiviti' => 'required|date',
            'masa_aktiviti' => 'required',
            'tempat_aktiviti' => 'required',
            'deskripsi_aktiviti' => 'required',
        ]);

        if ($request->hasFile('gambar_aktiviti')) {
            $image = $request->file('gambar_aktiviti');
            $name = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/aktiviti');
            $image->move($destinationPath, $name);
            $incomingFields['gambar_aktiviti'] = $name;
        } else {
            unset($incomingFields['gambar_aktiviti']);
        }

        //This is a security measure to prevent Cross-Site Scripting (XSS) attacks, which are a common attack vector for malicious users.
        $incomingFields['tajuk_aktiviti'] = strip_tags($incomingFields['tajuk_aktiviti']);
        $incomingFields['gambar_aktiviti'] = strip_tags($incomingFields['gambar_aktiviti']);
        $incomingFields['tarikh_aktiviti'] = strip_tags($incomingFields['tarikh_aktiviti']);
        $incomingFields['masa_aktiviti'] = strip_tags($incomingFields['masa_aktiviti']);
        $incomingFields['tempat_aktiviti'] = strip_tags($incomingFields['tempat_aktiviti']);
        $incomingFields['deskripsi_aktiviti'] = strip_tags($incomingFields['deskripsi_aktiviti']);

        $aktiviti->update($incomingFields);

        return redirect()->route('aktiviti.index')->with('success', 'Aktiviti berjaya dikemaskini!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aktiviti $aktiviti)
    {
        $aktiviti->delete();
        return redirect()->route('aktiviti.index')->with('success', 'Aktiviti berjaya dipadam!');
    }
}
