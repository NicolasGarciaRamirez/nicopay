<?php

namespace App\Http\Controllers\Balance;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance\BalanceHistory;
use App\Models\Transactions\Transaction;

class BalanceController extends Controller
{
	public function index()
    {
		$user = auth()->user()->load('balance');
        return Inertia::render('Balance/index', ['user' => $user]);
    }

    public function store(Request $request)
    {
		$user = auth()->user();
        // Valida los datos del formulario según tus necesidades
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);
		// el observador de trransaction crea el balance history automaticamente
		$transaction = new Transaction();
		$transaction->amount = $request->input('amount');
		$transaction->name = 'Carga De Saldo';
		$transaction->description = 'Carga de saldo';
		$transaction->type = $request->input('type');
		$user->transactions()->save($transaction);
        // Realiza cualquier otra lógica necesaria para actualizar el saldo del usuario

        // Redirige a la página de historial de saldo
		return Inertia::render('Balance/index', ['user' => $user->load('balance')]);

    }

    public function show()
    {
        $history = BalanceHistory::where('user_id', auth()->user()->id)->get();

        return Inertia::render('Balance/History', ['history' => $history]);
    }
}
