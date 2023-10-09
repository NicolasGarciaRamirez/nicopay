<?php

namespace App\Observers;

use App\Models\Balance\BalanceHistory;
use App\Models\Transactions\Transaction;

class TransactionObserver
{
	public $TYPES = [
		'SEND' => 'send',
		'RECEIVE' => 'receive',
		'CHARGE' => 'charge'
	];
    public function created(Transaction $transaction)
    {
        // Cuando se crea una transacción, actualiza el balance del usuario
        $user = $transaction->user;
        if ($user->balance) {
			// se optionen los saldos
			$amountTransaction = $transaction->amount;
			$currentBalance = $user->balance->amount;
			// se inicializa el amount que va a ser el nuevo saldo
			$amount = 0;
			// si el tipo de transaccion es enviar entonces descuenta saldo
			if($transaction->type === $this->TYPES['SEND']){
				$amount = $currentBalance - $amountTransaction;
			}
			// si el tipo de transaccion es recibir entonces aumenta saldo
			if($transaction->type === $this->TYPES['RECEIVE'] || $transaction->type === $this->TYPES['CHARGE']){
				$amount = $currentBalance + $amountTransaction;
			}
			// se valida que el amount no vaya a ser cero
			if($amount !== 0){
				// Si el usuario ya tiene un balance, actualiza su monto
				$user->balance->update([
					'amount' => $amount
				]);
			}
			// se crea el balance history para la caga del saldo
			$balance = new BalanceHistory();
			$balance->user_id = $user->id;
			$balance->amount = $transaction->amount;
			$balance->transaction_id = $transaction->id;
			$balance->save();


        } else {
            // Si el usuario no tiene un balance, crea uno nuevo
            $user->balance()->create([
                'amount' => $transaction->amount,
				'currency' => 'COP'
            ]);
        }
    }

    public function deleted(Transaction $transaction)
    {
        // Cuando se elimina una transacción, resta el monto del balance del usuario
        $user = $transaction->user;
        if ($user->balance) {
            // Si el usuario tiene un balance, resta el monto
            $user->balance->update([
                'amount' => $user->balance->amount - $transaction->amount,
				'currency' => 'COP'
            ]);
        }
    }
}
