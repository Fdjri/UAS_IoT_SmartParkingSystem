<?php

namespace App\Http\Controllers;

use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function getSlots(Request $request)
    {
        $filter = $request->query('status', 'isi');

        $slots = ParkingSlot::where('status', $filter == 'isi' ? 1 : 0)
                            ->orderBy('date') 
                            ->get();

        $days = $this->getDaysFromSlots($slots);
        $slotData = [
            'slot1' => $this->getSlotStatus($slots, 1), // Slot 1
            'slot2' => $this->getSlotStatus($slots, 2), // Slot 2
            'slot3' => $this->getSlotStatus($slots, 3), // Slot 3
        ];

        $response = [
            'days' => $days,
            'slots' => $slotData,
            'currentStatus' => [
                $this->getCurrentStatus($slotData['slot1']),
                $this->getCurrentStatus($slotData['slot2']),
                $this->getCurrentStatus($slotData['slot3']),
            ]
        ];

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'slot1' => 'required|boolean',
            'slot2' => 'required|boolean',
            'slot3' => 'required|boolean',
        ]);

        $slot1 = new ParkingSlot([
            'slot_number' => 1,
            'status' => $request->input('slot1'),
            'date' => now()->format('Y-m-d'), 
        ]);
        $slot1->save();

        $slot2 = new ParkingSlot([
            'slot_number' => 2,
            'status' => $request->input('slot2'),
            'date' => now()->format('Y-m-d'),
        ]);
        $slot2->save();

        $slot3 = new ParkingSlot([
            'slot_number' => 3,
            'status' => $request->input('slot3'),
            'date' => now()->format('Y-m-d'),
        ]);
        $slot3->save();

        return response()->json(['message' => 'Data slot parkir berhasil disimpan'], 200);
    }

    private function getDaysFromSlots($slots)
    {
        return $slots->pluck('date')->unique()->map(function ($date) {
            return 'Hari ' . date('j', strtotime($date));
        });
    }

    private function getSlotStatus($slots, $slotNumber)
    {
        return $slots->where('slot_number', $slotNumber)->pluck('status')->toArray();
    }

    private function getCurrentStatus($slotData)
    {
        return end($slotData);
    }
}
