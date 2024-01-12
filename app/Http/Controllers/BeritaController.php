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
        $berita = berita::all();

        // return view('Berita.berita_umum',[
        //  'berita' => $berita, ]);

        $berita = Berita::orderBy('created_at', 'ASC')->get();


        return view('Berita.berita_umum', compact('berita'));
    }

    public function search(Request $request)
    {
        $search_text = $_GET['query']; // Get the 'query' parameter from the request, default to an empty string if not present
        $berita = Berita::where('name', 'LIKE', '%' . $search_text . '%')
            ->orWhere('description', 'LIKE', '%' . $search_text . '%')
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
            ->with('success', 'Product created successfully.');
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


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        /*  $berita = Berita::find($id);
        return view('Berita.edit_berita', compact('berita')); */

        return view('Berita.edit_berita', compact('berita'));
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
        } else {
            unset($input['image']);
        }

        $berita->update($input);

        return redirect('berita_umum')
            ->with('success', 'Product updated successfully');
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
}
