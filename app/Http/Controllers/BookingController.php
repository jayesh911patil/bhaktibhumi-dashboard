<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use DataTables;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function Booking(Request $request)
    {
        if ($request->ajax()) {

            $data = Booking::select('bookings.*')
                ->with('room')
                ->whereHas('room', function ($q) {
                    $q->where('added_by', auth()->user()->partner_with_us_id);
                });

            return DataTables::of($data)
                ->addColumn('customer_name', function ($row) {
                    return $row->name;
                })
                ->addColumn('room_type', function ($row) {
                    return config('constants.ROOM_TYPE')[$row->room->room_type] ?? 'Unknown';
                })
                ->addColumn('arrive_from', function ($row) {
                    return Carbon::parse($row->check_in)->format('d M Y');
                })
                ->addColumn('arrive_to', function ($row) {
                    return Carbon::parse($row->check_out)->format('d M Y');
                })
                ->make(true);
        }

        return view('booking.booking');
    }

    public function bookingsData()
    {
        $query = Booking::with('room')
            ->whereHas('room', function ($q) {
                $q->where('added_by', auth()->user()->partnerid);
            });

        return DataTables::of($query)
            ->addColumn('customer_name', function ($row) {
                return $row->name;
            })
            ->addColumn('room_type', function ($row) {
                return config('constants.ROOM_TYPE')[$row->room->room_type] ?? 'Unknown';
            })
            ->addColumn('arrive_from', function ($row) {
                return \Carbon\Carbon::parse($row->check_in)->format('d M Y');
            })
            ->addColumn('arrive_to', function ($row) {
                return \Carbon\Carbon::parse($row->check_out)->format('d M Y');
            })
            ->rawColumns(['room_type'])
            ->make(true);
    }
}
