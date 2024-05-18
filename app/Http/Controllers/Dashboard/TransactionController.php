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
        return view('dashboard.transactions')
            ->with('transactions', Transaction::paginate());
    }
}
