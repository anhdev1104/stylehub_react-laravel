<?php 
namespace App\Services;

use App\Models\Order;

class StatisticalService {
    public function orderStatistical($request) {
        $start = $request->query('start');
        $end = $request->query('end');
    
        $query = Order::query();
    
        if ($request->has('start') && $request->has('end')) {
            $query->whereBetween('order_date', [$start, $end]);
        }
    
        $query->where('status', 'delivered');

        $orderTotal = $query->sum('total_amount');
    
        return ['data' => $orderTotal];
    }

    public function countOrder($request) {
        $status = $request->query('status');

        $query = Order::query();

        if ($request->has('status')) {
            $query->where('status', $status);
        }

        $orderTotal = $query->count();

        return ['data' => $orderTotal];
    }
}