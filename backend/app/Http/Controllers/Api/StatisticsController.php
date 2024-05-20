<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class StatisticsController extends Controller
{
    private Model $model;

    public function transactions(Request $request): JsonResponse
    {
        $this->model = Transaction::getModel();

        $stats = Transaction::selectRaw('SUM(amount) as total_amount, AVG(amount) as average_amount, COUNT(*) as total_count, SUM(fee) as total_fees')
            ->first()
            ->toArray();

        $statYear = $request->year ?? date('Y');
        $statMonth = $request->month ?? date('m');

        return response()->json([
            'message' => 'Transactions statistics',
            'data' => [
                'stats' => [
                    'total_amount' => money($stats['total_amount'] / 100),
                    'average_amount' => money($stats['average_amount'] / 100),
                    'total_count' => $stats['total_count'],
                    'total_fees' => money((float) $stats['total_fees'])
                ],
                'charts' => [
                    'daily' => $this->getDaily($statYear, $statMonth),
                    'monthly' => $this->getMonthly($statYear),
                    'yearly' => $this->getYearly()
                ]
            ]
        ]);
    }

    private function getDaily(string $statYear, string $statMonth): array
    {
        $days = array_fill_keys(range(1, 31), 0);

        $data = $this->model->selectRaw('count(id) as count, day(created_at) as day')
            ->whereYear('created_at', $statYear)
            ->whereMonth('created_at', $statMonth)
            ->groupBy('day')
            ->get()
            ->pluck('count', 'day');

        foreach ($data as $day => $count) {
            $days[$day] = $count;
        }

        return $days;
    }

    private function getMonthly(string $statYear): array
    {
        $months = array_fill_keys(array_map(function($m) { return date('M', mktime(0, 0, 0, $m, 10)); }, range(1, 12)), 0);

        $data = $this->model->selectRaw('count(id) as count, month(created_at) as month')
            ->whereYear('created_at', $statYear)
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month');

        foreach ($data as $month => $count) {
            $monthName = date('M', mktime(0, 0, 0, $month, 10));
            $months[$monthName] = $count;
        }

        return $months;
    }

    private function getYearly(): array
    {
        return $this->model->selectRaw('count(id) as count, year(created_at) as year')
            ->groupBy('year')
            ->get()->mapWithKeys(function ($item) {
                return [
                    $item->year => $item->count
                ];
            })->toArray();
    }
}
