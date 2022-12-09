<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateUserPhonesFormat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:user-phones-format';

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

        $users = User::query()->get();

        foreach ($users as $user) {
            $rawPhone = Str::replace(str_split( '()_- '), '', $user->mobile_phone);

            $country = $countries->filter(fn($c) => Str::startsWith($rawPhone, $c->phone_code))->first();

            if($country) {
                $cleanPhone = Str::replace($country->phone_code, '', $rawPhone);
                $cleanPhoneParts = str_split($cleanPhone);
                $formatParts = str_split($country->phone_mask);
                $newNumber = '';
                while($char = array_shift($formatParts)) {
                    if(is_numeric($char)) {
                        $newNumber .= array_shift($cleanPhoneParts);
                    } else {
                        $newNumber .= $char;
                    }
                }

                $user->mobile_phone = $country->phone_code . ' ' . $newNumber;
                $user->save();
            }

        }

        return 0;
    }
}
