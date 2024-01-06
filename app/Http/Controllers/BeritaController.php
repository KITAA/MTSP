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
        $berita = berita::all();

        // return view('Berita.berita_umum',[
        //  'berita' => $berita, ]);

        $berita = Berita::orderBy('created_at', 'ASC')->get();
        
 
        return view('Berita.berita_umum', compact('berita'));
      
    }

    public function search(Request $request)
    {
        $search_text = $_GET['query']; // Get the 'query' parameter from the request, default to an empty string if not present
        $berita = Berita::where('name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('description', 'LIKE', '%'.$search_text.'%')
        ->get();
        return view('Berita.berita_umum', compact('berita')); 

       /*  $search = $request->search;

        $berita = Berita::where(function($query) use($search){

            $query->where('name', 'LIKE', "%$search%")
            ->orWhere('description', 'LIKE', "%$search%");
        })
        ->get();

        return view('Berita.details_berita', compact('berita', 'search')); */
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
        return view('Berita.create_berita');
    }


    public function createAktiviti()
    {
        return view('Berita.tambah_aktiviti');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
/*         $berita = new Berita();

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
    
     return redirect()->route('berita umum');*/

    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $input = $request->all();

    if ($image = $request->file('image')) {
        $destinationPath = 'images/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $input['image'] = "$profileImage";
    }
 
    Berita::create($input);
  
    return redirect()->route('berita umum')
                    ->with('success','Product created successfully.');
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
      /*   $berita = Berita::find($id);
        return view('Berita.details_berita', compact('berita')); */

        return view('Berita.details_berita', compact('berita'));
        
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
       /*  $berita = Berita::find($id);
        return view('Berita.edit_berita', compact('berita')); */

        return view('Berita.edit_berita',compact('berita'));
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

    public function update(Request $request, Berita $berita)
    {
     /*    
        $berita = Berita::find($id);
        $berita->name = $request->input('name');
        $berita->description = $request->input('description');

        if($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $berita->image = $filename;

         } else {
        return $request;
        $berita->image = '';
    }

        $berita->save(); 

      
        return redirect('berita_umum'); */

        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
   
        $input = $request->all();
   
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
           
        $berita->update($input);
     
        return redirect('berita_umum')
                        ->with('success','Product updated successfully');
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
      // Check if the Berita is found
      if (!$berita) {
          abort(404); // You can customize this to your specific needs
      }
  
      // Delete the image file
      if (!empty($berita->image)) {
          $imagePath = public_path('images/') . $berita->image;
  
          if (file_exists($imagePath)) {
              unlink($imagePath);
          }
      }
  
      // Delete the Berita record
      $berita->delete();

        return back();
    }

    public function destroyAktiviti(Aktiviti $aktiviti)
    {
        $aktiviti->delete();

        return redirect()->route('berita.aktiviti')->with('success', 'Aktiviti berjaya dipadam!');
    }
}