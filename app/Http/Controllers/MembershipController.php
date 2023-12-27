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
        $usertype = auth()->user()->usertype;

        if($usertype == 'user'){
            $user = auth()->user();

            if (!$user->membership) {
                return redirect()->route('membership.create');
            }

            $membership = $user->membership;

            return view('E-khairat.semak_ahli', [
                'membership' => $membership,
            ]);
        }

        elseif($usertype == 'admin'){
            $memberships = Membership::all();

            return view('admin.senarai_ahli', [
                'memberships' => $memberships,
            ]);
        }
    }

    public function info()
    {
        return view('E-khairat.polisi');
    }

    public function confirmation(StoreMembershipRequest $request)
    {   
        if(session()->has('confirmation_data')){
            session()->forget('confirmation_data');
        }
        
        
        $validated = $request->validated();

        $request->session()->put('confirmation_data', [
            'membership' => $validated,
            'tanggungans' => $request->input('tanggungans', []),
        ]);

        return view('E-khairat.confirmation', [
            'membership' => $validated,
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
            'membership' => $confirmationData['membership'],
            'tanggungans' => $confirmationData['tanggungans'],
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $user = auth()->user();
        if ($user->membership) {
            return redirect()->route('membership.index');
        }
        return view('E-khairat.daftar_ahli');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $user = auth()->user();

        $confirmationData = session('confirmation_data');

        $ahliData = $confirmationData['membership'];
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
        return view('E-khairat.semak_ahli', [
            'membership' => $membership,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        $this->authorize('edit-membership', $membership);

        return view('E-khairat.daftar_ahli', [
            'membership' => $membership,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $validated = $request->validated();

        $membership->update([
            'fullname' => $validated['fullname'],
            'ic' => $validated['ic'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'emergency_no' => $validated['emergency_no'],
        ]);

        $tanggungans = $request->input('tanggungans', []);
        
        foreach ($tanggungans as $tanggunganData) {
            foreach ($membership->tanggungan as $tanggungan) {
            
                    $tanggungan->update([
                        'fullname' => $tanggunganData['fullname'],
                        'ic' => $tanggunganData['ic'],
                        'relationship' => $tanggunganData['relationship'],
                    ]);
                
            }
        }

        return redirect()->route('membership.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
