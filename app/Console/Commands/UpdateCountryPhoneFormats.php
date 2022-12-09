<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;

class UpdateCountryPhoneFormats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:country-phone-formats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $countries = Country::query()->get();

        $ua = $countries->where('iso', 'UA')->first();
        $pl = $countries->where('iso', 'PL')->first();
        $sk = $countries->where('iso', 'SK')->first();
        $ro = $countries->where('iso', 'RO')->first();

        if($ua) {
            $ua->update([
                'phone_code' => '+380',
                'phone_mask' => '99 999-99-99',
                'phone_rule' => '/^\+380 \d{2} \d{3}-\d{2}-\d{2}$/',
            ]);
        }

        if($pl) {
            $pl->update([
                'phone_code' => '+48',
                'phone_mask' => '999-999-999',
                'phone_rule' => '/^\+48 \d{3}-\d{3}-\d{3}$/',
            ]);
        }

        if($sk) {
            $sk->update([
                'phone_code' => '+421',
                'phone_mask' => '999-999-999',
                'phone_rule' => '/^\+421 \d{3}-\d{3}-\d{3}$/',
            ]);
        }

        if($ro) {
            $ro->update([
                'phone_code' => '+40',
                'phone_mask' => '999-999-999',
                'phone_rule' => '/^\+40 \d{3}-\d{3}-\d{3}$/',
            ]);
        }

        return 0;
    }
}
