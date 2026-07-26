<?php
namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $rooms = Room::when($search, function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where('room_name', 'like', "%{$search}%")
                    ->orWhere('building_name', 'like', "%{$search}%");

            });

        })
            ->orderBy('room_name')
            ->paginate(10)
            ->withQueryString();

        return view('room.index', compact('rooms', 'search'));
    }

    public function create()
    {
        return view('room.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_name'     => [
                'required',
                'max:20'
            ],
            'building_name'     => [
                'required',
                'max:100',
            ],
            'capacity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        Room::create($validated);

        return redirect()
            ->route('room.index')
            ->with('success', 'Room berhasil ditambahkan.');
    }

    public function edit(Room $room)
    {
        return view('room.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_name'     => [
                'required',
                'max:20',
                Rule::unique('rooms', 'room_name')->ignore($room->id),
            ],
            'building_name'     => [
                'required',
                'max:100',
            ],
            'capacity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $room->update($validated);

        return redirect()
            ->route('room.index')
            ->with('success', 'Room berhasil diubah.');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()
            ->route('room.index')
            ->with('success', 'Room berhasil dihapus.');
    }
}
