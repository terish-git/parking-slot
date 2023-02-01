<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slot;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($j=0; $j<26; $j++) {
            for($i=0; $i<5; $i++) {
                $slot = Slot::create([
                    'name'     => chr(65+$j) . 0 . $i+1,
                ]);
            }
        }
    }
}
