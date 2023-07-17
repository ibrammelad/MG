<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Service\OrderService;
use PDF;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function makeOrder(OrderRequest $request)
    {
        $result = OrderService::serviceOrder($request);
        return response()->json($result, 200);
    }
    public function checkoutAndPrintInvoice(Request $request)
    {
        $pdfContent = OrderService::printInvoice($request);
        return response()->json([
            'success' => true,
            'invoice' => base64_encode($pdfContent)
        ]);
    }

}
