<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Http\Requests\EKhairat\StoreMembershipRequest;
use App\Http\Requests\EKhairat\UpdateMembershipRequest;
use App\Models\Payment;
use App\Notifications\DaftarAhliNotification;
use App\Models\User;
use App\Notifications\StatusAhliNotification;
use Illuminate\Http\Request;

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
        $existingTanggunganIds = [];

        foreach ($tanggungans as $tanggungan) {
            $tanggunganData = [
                'fullname' => $tanggungan['fullname'],
                'ic' => $tanggungan['ic'],
                'relationship' => $tanggungan['relationship'],
            ];

            if (isset($tanggungan['id'])) {
                $membership->tanggungan()->where('id', $tanggungan['id'])->update($tanggunganData);
                $existingTanggunganIds[] = $tanggungan['id'];
            } else {
                $createdTanggungan = $membership->tanggungan()->create($tanggunganData);
                $existingTanggunganIds[] = $createdTanggungan->id;
            }
    }

    $membership->tanggungan()->whereNotIn('id', $existingTanggunganIds)->delete();


        return redirect()->route('membership.index');
    }

    public function search(){
        $search = $_GET['query'];
        $membership = Membership::where('fullname', 'LIKE', '%'.$search.'%')
        ->orWhere('ic', 'LIKE', '%'.$search.'%')
        ->orWhere('email', 'LIKE', '%'.$search.'%')
        ->get();

        return view('admin.senarai_ahli', [
            'memberships' => $membership,
            'search' => $search,
        ]);
    }

    public function bayar(Request $request){
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        $userHasMembership = auth()->user()->membership;

        $successRoute = $userHasMembership ? 'membership.renew' : 'membership.store';

        $response = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => ['name' => $request->membership_type,],
                    'unit_amount' => $request->price * 100,
                ],
                'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route($successRoute).'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('membership.cancel'),
        ]);

        if(isset($response->id) && ($response->id != null)){

            session()->put('payment_data', [
                'membership_type' => $request->membership_type,
                'price' => $request->price,
            ]);

            return redirect($response->url);
        }else{
            return redirect()->route('cancel');
        }

    }

    public function success(Payment $payment){

            return view('E-khairat.success', [
            'membership' => $payment,
        ]);
    }

    public function cancel(){
        return view('E-khairat.cancel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(isset($request->session_id)){
            
            $user = auth()->user();
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id, []);

            $paymentData = session('payment_data');
            $confirmationData = session('confirmation_data');

            if($paymentData['membership_type'] == 'Bulanan'){
                $membershipDuration = 1;
            }
            elseif($paymentData['membership_type'] == 'Tahunan'){
                $membershipDuration = 12;
            }


            $ahliData = $confirmationData['membership'];
            $tanggungansData = $confirmationData['tanggungans'];

            $membership = $user->membership()->create([
                'fullname' => $ahliData['fullname'],
                'ic' => $ahliData['ic'],
                'address' => $ahliData['address'],
                'phone' => $ahliData['phone'],
                'emergency_no' => $ahliData['emergency_no'],
                'email' => $ahliData['email'],
                'membershipDuration' => $membershipDuration,
            ]);

            foreach ($tanggungansData as $tanggunganData) {
                $membership->tanggungan()->create([
                    'fullname' => $tanggunganData['fullname'],
                    'ic' => $tanggunganData['ic'],
                    'relationship' => $tanggunganData['relationship'],
                ]);
            }

            session()->forget('confirmation_data');

            $payment = $membership->payment()->create([
                'payment_id' => $response->id,
                'membership_type' => $paymentData['membership_type'],
                'status' => $response->payment_status,
                'method' => "Stripe",
                'price' => $paymentData['price'],
                'currency' => $response->currency,
                'name' => $response->customer_details->name,
                'email' => $response->customer_details->email,
            ]);

            session()->forget('payment_data');
            session()->put('payment', $payment);
            
            $admins = User::where('usertype', 'admin')->get();
            $admins->each(function ($admin) use ($membership) {
                $admin->notify(new DaftarAhliNotification($membership));
            });
            
            
        }

        else{
            return redirect()->route('membership.cancel');
        }
        
        
        return redirect()->route('send.email');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        return "payment is canceled";
    }

    public function Approve(Membership $membership){
        $membership->update([
            'status' => 'Aktif',
        ]);

        $title = 'Keahlian telah Aktif';
        $message = 'Pendaftaran anda telah diluluskan.';

        User::where('id', $membership->user_id)->first()->notify(new StatusAhliNotification($title, $message));

        return redirect()->route('membership.index');
    }

    public function Reject(Membership $membership){

        $reason = $_POST['reject_reason'];
        $title = 'Maklumat Pendaftaran perlu Dibaiki';
        $message = $reason;

        User::where('id', $membership->user_id)->first()->notify(new StatusAhliNotification($title, $message));
        return redirect()->route('membership.index');
    }

    public function renew(Request $request){
        if(isset($request->session_id)){
            $user = auth()->user();
            $membership = $user->membership;
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id, []);
            $paymentData = session('payment_data');

            if($paymentData['membership_type'] == 'Bulanan'){
                $membershipDuration = 1;
            }
            elseif($paymentData['membership_type'] == 'Tahunan'){
                $membershipDuration = 12;
            }

            $membership->update([
                'membershipDuration' => $membershipDuration,
                'status' => 'Aktif',
            ]);

            $payment = $membership->payment()->create([
                'payment_id' => $response->id,
                'membership_type' => $paymentData['membership_type'],
                'status' => $response->payment_status,
                'method' => "Stripe",
                'price' => $paymentData['price'],
                'currency' => $response->currency,
                'name' => $response->customer_details->name,
                'email' => $response->customer_details->email,
            ]);

            session()->put('payment', $payment);
            session()->forget('payment_data');
        }

        else{
            return redirect()->route('membership.cancel');
        }

        return redirect()->route('send.email');
    }
}
