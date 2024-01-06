<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Aktiviti;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function beritaMasjid()
    {
        return view('Berita.berita_masjid');
    }

    public function aktiviti()
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

        return view('Berita.aktiviti', [
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
        //
    }

    public function createAktiviti()
    {
        return view('Berita.tambah_aktiviti');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBeritaRequest $request)
    {
        //
    }

    public function storeAktiviti(Request $request)
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

        return redirect()->route('berita.aktiviti')->with('success', 'Aktiviti berjaya ditambah!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        //
    }

    public function showAktiviti(Aktiviti $aktiviti)
    {
        return view('Berita.lihat_aktiviti', [
            'aktiviti' => $aktiviti,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        //
    }

    public function editAktiviti(Aktiviti $aktiviti)
    {
        return view('Berita.edit_aktiviti', [
            'aktiviti' => $aktiviti,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBeritaRequest $request, Berita $berita)
    {
        //
    }

    public function updateAktiviti(Request $request, Aktiviti $aktiviti)
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
        else {
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

        return redirect()->route('berita.aktiviti')->with('success', 'Aktiviti berjaya dikemaskini!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        //
    }

    public function destroyAktiviti(Aktiviti $aktiviti)
    {
        $aktiviti->delete();

        return redirect()->route('berita.aktiviti')->with('success', 'Aktiviti berjaya dipadam!');
    }
}
