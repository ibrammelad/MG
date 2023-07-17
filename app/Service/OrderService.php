<?php

namespace App\Service;


use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderDetail;
use PDF;

class OrderService
{
    public static function serviceOrder($request)
    {
        $meals = $request->meals;
        $total = 0;
        $orderDetails = [];
        for ($i = 0; $i < count($meals); $i++) {
            $mealId = $meals[$i];
            $meal = Meal::find($mealId);
            if ($meal) {
                $price = $meal->price;
                $discount = $meal->discount;
                $amountToPay = $price - $discount;
                $total += $amountToPay;

                $orderDetails[] = [
                    'meal_id' => $mealId,
                    'amount_to_pay' => $amountToPay,
                ];
            }
        }
        $input['table_id'] = $request->table_id;
        $input['customer_id'] = $request->customer_id;
        $input['reservation_id'] = $request->reservation_id;
        $input['total'] = $total;
        $input['paid'] = 0;
        $input['date'] = now()->toDateString();
        $order = Order::create($input);

        foreach ($orderDetails as $orderDetail) {
            $orderDetail['order_id'] = $order->id;
            OrderDetail::create($orderDetail);
        }
        $result = Order::with('orderDetails.meal')->find($order->id);
        return $result;
    }
    public static function printInvoice($request){
        $tableId = $request->table_id;
        $customerId = $request->customer_id;
        $order = Order::with('orderDetails')
            ->where('customer_id', $customerId)
            ->where('table_id', $tableId)
            ->where('paid', false)->first();
        if (!$order) {
            return response()->json([
                'error' => 'No unpaid order found for the specified table and customer'
            ], 404);
        }
        $order->paid = true;
        $order->save();
        $pdf = PDF::loadView('invoice', ['order' => $order]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdfContent = $pdf->output();
        return $pdfContent;
    }
}
