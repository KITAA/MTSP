<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Requests\Berita\StoreBeritaRequest;


class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::orderBy('created_at', 'ASC')->get();
        return view('Berita.berita_umum', compact('berita'));
    }

    public function search(Berita $berita)
    {
         $search_text = isset($_GET['query']) ? $_GET['query'] : '';

        $berita = Berita::where('name', 'LIKE', '%' . $search_text . '%')
            ->orWhere(function ($query) use ($search_text) {
                $query->where('description', 'LIKE', '%' . $search_text . '%')
                    ->orWhereRaw('description LIKE ?', ['%' . $search_text . '%']);
            })
            ->get();

        return view('Berita.berita_umum', compact('berita', 'search_text')); 

      
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
    public function store(StoreBeritaRequest $request, Berita $berita)
    {



        $validated = $request->validated();



        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $validated['image'] = $profileImage;

        }



        $berita = Berita::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $validated['image'],

        ]);


        return redirect()->route('berita umum')
            ->with('success', 'Product created successfully.');
    }







    /**
     * Display the specified resource.
     */
    /* public function show(Berita $berita)
    {
        $previousBerita = Berita::where('id', '<', $berita->id)->orderByDesc('id')->first();
        $nextBerita = Berita::where('id', '>', $berita->id)->orderBy('id')->first();

        return view('Berita.details_berita', compact('berita', 'previousBerita', 'nextBerita'));
    } */

    public function show(Berita $berita)
    {
        $berita = Berita::find($berita->id);
        $previousBerita = Berita::where('id', '<', $berita->id)->orderByDesc('id')->first();
        $nextBerita = Berita::where('id', '>', $berita->id)->orderBy('id')->first();

        return view('Berita.details_berita', compact('berita', 'previousBerita', 'nextBerita'));
    }

    /* public function next(Berita $berita)
    {
        $nextBerita = Berita::where('id', '>', $berita->id)->orderBy('id')->first();

        return redirect()->route('details.berita', $nextBerita->id);
    }

    public function previous(Berita $berita)
    {
        $previousBerita = Berita::where('id', '<', $berita->id)->orderByDesc('id')->first();

        return redirect()->route('details.berita', $previousBerita->id);
    } */

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
