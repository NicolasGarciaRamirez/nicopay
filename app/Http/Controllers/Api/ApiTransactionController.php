<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use App\Models\Transactions\Transaction;
use Illuminate\Http\Response as HttpResponse;

class ApiTransactionController extends Controller
{
    public function createTransactionCharge(Request $request)
	{
		try {
			$user = auth()->user();
			// Valida los datos del formulario según tus necesidades
			$request->validate([
				'amount' => 'required|numeric|min:0',
			]);
			// el observador de trransaction crea el balance history automaticamente
			$transaction = $this->createTransaction($request, 'charge');
			$user->transactions()->save($transaction);

			return response()->json([
				'transaction' => $transaction,
				'transaction_status' => 'success',
				'error_message' => null
			], HttpResponse::HTTP_OK);

		} catch (\Throwable $th) {
			return response()->json([
				'transaction' => null,
				'transaction_status' => 'error',
				'error_message' => $th
			], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
		}
	}

	public function createTransactionReceive(Request $request)
	{
		try {
			$request->validate([
				'amount' => 'required|numeric|min:0',
			]);
			$user = auth()->user();
			// el observador de trransaction crea el balance history automaticamente
			$transaction = $this->createTransaction($request, 'receive');
			$user->transactions()->save($transaction);
	
			return response()->json([
				'transaction_id' => $transaction->id,
				'transaction_status' => 'success',
				'error_message' => null
			],HttpResponse::HTTP_OK);

		} catch (\Throwable $th) {
			return response()->json([
				'transaction_id' => null,
				'transaction_status' => 'error',
				'error_message' => $th
			], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
		}
	}

	public function createTransactionSend(Request $request)
	{
		try {
			$request->validate([
				'amount' => 'required|numeric|min:1',
				'description' => 'required|string',
				'name' => 'required|string',
				'userName' => 'required|string'
			]);
			$user = auth()->user();
			// el observador de trransaction crea el balance history automaticamente
			// se crea la transaccion de envio
			$transaction = $this->createTransaction($request, 'send');
			$user->transactions()->save($transaction);
			// se obtiene el usuario al que se le va a enviar dinero y se le realiza 
			// una transaction de tipo receibe al usuario por el monto que se envia
			$userReceptor = User::where('name', $request->userName)->first();
			$transactionSend = $this->createTransaction($request, 'receive');
			$userReceptor->transactions()->save($transactionSend);
			return response()->json([
				'transaction_id' => $transaction->id,
				'transaction_status' => 'success',
				'error_message' => null,
				'success_message' => 'Se envio exitosamente el dinero'
			],HttpResponse::HTTP_OK);

		} catch (\Throwable $th) {
			return response()->json([
				'transaction_id' => null,
				'transaction_status' => 'error',
				'error_message' => $th,
				'success_message' => null
			], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
		}
	}

	private function createTransaction($request, $type)
	{
		$transaction = new Transaction();
		$transaction->amount = $request->input('amount');
		$transaction->name = $request->input('name');
		$transaction->description = $request->input('description');
		$transaction->type = $type;

		return $transaction;
	}
}
