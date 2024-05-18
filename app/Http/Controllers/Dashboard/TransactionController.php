<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class TransactionController extends Controller
{
    public function list(): View
    {
        $transactions = Transaction::latest()
            ->get();

        return view('dashboard.transactions', compact('transactions'));
    }
}
