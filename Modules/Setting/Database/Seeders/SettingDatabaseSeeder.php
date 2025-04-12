<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        Setting::create([
            'company_name' => 'Warkit',
            'company_email' => 'warkit@gmail.com',
            'company_phone' => '012345678901',
            'notification_email' => 'notifwarkit@gmail.com',
            'default_currency_id' => 1,
            'default_currency_position' => 'prefix',
            'footer_text' => ' Warkit © 2025',
            'company_address' => 'Madura, Indonesia'
        ]);
    }
}
