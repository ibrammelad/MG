<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Waiting;
use App\Service\ReservationService;


class ReserveTableController extends Controller
{
    public function reserveTable(ReservationRequest $request)
    {
        $input = ReservationService::reserveService($request);
        if ($input == null) {
            return $this->errorResponse("No Available table in this time and number of guest", 404);
        } else {
            $reservation = Reservation::create($input);
            return $this->showOne($reservation, 200);
        }

    }

    public function reserveTableWithWaitingList(ReservationRequest $request)
    {
        $input = ReservationService::reserveService($request);
        if ($input == null) {
            $wating = Waiting::updateOrCreate([
                'customer_id' => $request->customer_id,
                'num_guests' => $request->num_guests
            ]);
            return response()->json(["message"=>"No Available table in this time and number of guest you put in waiting list with number ".$wating->id , "code"=>200]);
        } else {
            $reservation = Reservation::create($input);
            return $this->showOne($reservation, 200);
        }

    }

}
