<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Membership;
use Carbon\Carbon;

class UpdateMembershipStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-membership-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update membership status based on plan duration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $memberships = Membership::where('status', 'Aktif')->get();
        foreach ($memberships as $membership) {
            $expiryDate = Carbon::parse($membership->created_at)->addMonths($membership->membershipDuration);

            if (now() >= $expiryDate) {
                $membership->update(['status' => 'Tamat tempoh']);
            }
        }

        $memberships = Membership::where('status', 'Tamat tempoh')->get();
        foreach ($memberships as $membership) {
            $expiryDate = Carbon::parse($membership->created_at)->addMonths(4);

            if (now() >= $expiryDate) {
                $membership->update(['status' => 'Dilucutkan']);
            }
        }

    }
}
