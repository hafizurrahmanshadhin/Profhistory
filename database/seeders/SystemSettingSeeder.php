<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder {
    public function run(): void {
        DB::table('system_settings')->insert([
            [
                'id'             => 1,
                'title'          => 'Profhistory',
                'system_name'    => 'Profhistory',
                'email'          => 'profhistory@profhistory.com',
                'phone_number'   => '0123456789',
                'address'        => 'Dhaka, Bangladesh',
                'copyright_text' => '©Profhistory',
                'description'    => '<p>About System...</p>',
                'logo'           => null,
                'favicon'        => null,
                'created_at'     => '2024-12-08 05:08:00',
                'updated_at'     => '2024-12-08 05:08:00',
            ],
        ]);
    }
}
