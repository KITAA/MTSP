<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Http\Requests\EKhairat\StoreMembershipRequest;
use App\Http\Requests\EKhairat\UpdateMembershipRequest;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function info()
    {
        return view('E-khairat.polisi');
    }

    public function confirmation(StoreMembershipRequest $request)
    {   
        if (session()->has('confirmation_data')) {
            session()->forget('confirmation_data');
        }

        $validated = $request->validated();

        $request->session()->put('confirmation_data', [
            'ahli' => $validated,
            'tanggungans' => $request->input('tanggungans', []),
        ]);

        return view('E-khairat.confirmation', [
            'ahli' => $validated,
            'tanggungans' => $request->input('tanggungans', []),
        ]);
    }

    public function editConfirmation()
    {
        $confirmationData = session('confirmation_data');

        if (empty($confirmationData)) {
            return redirect()->route('membership.create');
        }

        return view('E-khairat.daftar_ahli', [
            'ahli' => $confirmationData['ahli'],
            'tanggungans' => $confirmationData['tanggungans'],
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return view('E-khairat.daftar_ahli');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $user = auth()->user();

        $confirmationData = session('confirmation_data');

        $ahliData = $confirmationData['ahli'];
        $tanggungansData = $confirmationData['tanggungans'];

        $membership = $user->membership()->create([
            'fullname' => $ahliData['fullname'],
            'ic' => $ahliData['ic'],
            'address' => $ahliData['address'],
            'phone' => $ahliData['phone'],
            'emergency_no' => $ahliData['emergency_no'],
            'email' => $ahliData['email'],
        ]);

        foreach ($tanggungansData as $tanggunganData) {
            $membership->tanggungan()->create([
                'fullname' => $tanggunganData['fullname'],
                'ic' => $tanggunganData['ic'],
                'relationship' => $tanggunganData['relationship'],
            ]);
        }

        session()->forget('confirmation_data');

        return view('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
