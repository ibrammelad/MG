<?php

namespace App\Service;


use App\Models\Reservation;
use App\Models\Table;
use App\Traits\apiResponse;
use Carbon\Carbon;

class ReservationService
{
    use apiResponse;
    public static function reserveService($request)
    {
        $tables =  self::checkAvailability($request);
        if ($tables == [])
        {
            return null;
        }
        $input['table_id'] =$tables[0]->id;
        $input['customer_id'] =$request->customer_id;
        $input['from_time'] =$request->from_time;
        $input['to_time'] =$request->to_time;
        return $input;
    }

    private static function checkAvailability($request)
    {
        $startTime = $request->from_time;
        $endTime = $request->to_time;
        $numGuests = $request->num_guests;
        $tables = Table::all();
        $availableTables = [];
        foreach ($tables as $table) {
            if ($table->capacity >= $numGuests) {

                $overlappingReservations = Reservation::where('table_id', $table->id)
                    ->where(function ($query) use ($startTime, $endTime) {
                        $query->whereBetween('from_time', [$startTime, $endTime])
                            ->orWhereBetween('to_time', [$startTime, $endTime]);
                    })
                    ->count();
                if ($overlappingReservations == 0) {
                    $availableTables[] = $table;
                }
            }
        }
        return $availableTables;

    }
}
