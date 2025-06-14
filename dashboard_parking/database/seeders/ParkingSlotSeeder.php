<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParkingSlot;

class ParkingSlotSeeder extends Seeder
{
    public function run()
    {
        // Isi dengan data dummy
        ParkingSlot::create(['slot_number' => 1, 'date' => '2023-06-01', 'status' => 1]);
        ParkingSlot::create(['slot_number' => 1, 'date' => '2023-06-02', 'status' => 0]);
        ParkingSlot::create(['slot_number' => 2, 'date' => '2023-06-01', 'status' => 0]);
        ParkingSlot::create(['slot_number' => 2, 'date' => '2023-06-02', 'status' => 1]);
        ParkingSlot::create(['slot_number' => 3, 'date' => '2023-06-01', 'status' => 0]);
        ParkingSlot::create(['slot_number' => 3, 'date' => '2023-06-02', 'status' => 0]);
    }
}
