<?php

namespace App\Http\Controllers;

use App\Models\Berita;
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
        // $berita = berita::all();

        // return view('Berita.berita_umum',[
        //  'berita' => $berita, ]);

        $berita = Berita::orderBy('created_at', 'ASC')->get();
 
        return view('Berita.berita_umum', compact('berita'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Berita.create_berita');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $berita = new Berita();

        $berita-> name = $request->input('name');
        $berita-> description = $request->input('description');
        
        if($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('content/img/', $filename);
            $berita->image = $filename;

         } else {
        return $request;
        $berita->image = '';
    }
    
    $berita->save(); 

  

   

   return redirect()->route('berita umum');
 
  // return redirect()->route('Berita.berita_umum')->with('berjaya', 'Berita telah berjaya ditambah');
    
}
    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $berita = Berita::find($id);
        return view('Berita.details_berita', compact('berita'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
      //  $berita = Berita::findOrFail($berita->id);
        $berita = Berita::find($id);
        return view('Berita.edit_berita', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
/*     public function update(Request $request, Berita $berita)
    {
        //
        $berita_umum = Berita::findOrFail($berita);
        $berita_umum->update($request->all());
        return view('Berita.berita_umum')->with('Berita.berita_umum', $berita_umum);
    } */

    public function update(Request $request, $id)
    {
        //
        $berita = Berita::find($id);
        $berita->name = $request->input('name');
        $berita->description = $request->input('description');

        if($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('content/img/', $filename);
            $berita->image = $filename;

         } else {
        return $request;
        $berita->image = '';
    }

        $berita->save(); 

      
        return redirect('berita_umum');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      // Find the Berita by its ID
      $berita = Berita::find($id);

      // Check if the Berita is found
      if (!$berita) {
          abort(404); // You can customize this to your specific needs
      }
  
      // Delete the image file
      if (!empty($berita->image)) {
          $imagePath = public_path('content/img/') . $berita->image;
  
          if (file_exists($imagePath)) {
              unlink($imagePath);
          }
      }
  
      // Delete the Berita record
      $berita->delete();

        return back();
    }
}
