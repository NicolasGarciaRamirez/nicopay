<?php

namespace App\Console\Commands;

use App\Models\Plan\Plan;
use Illuminate\Console\Command;
use App\Models\Transactions\Transaction;
use App\Models\Subscription\Subscription;

class FacturarSubscripciones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

	public function __construct()
    {
        parent::__construct();
    }
	    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Obtener todos los planes activos
        $planes = Plan::where('activo', true)->get();

        foreach ($planes as $plan) {
            // Obtener todas las suscripciones activas para este plan
            $suscripciones = Subscription::where('plan_id', $plan->id)
                ->where('status', 'activo')
                ->get();

            foreach ($suscripciones as $subscription) {
                // Realizar la facturación aquí y calcular el monto a descontar
                $amountFactured = $plan->price;
                // Realizar el descuento del saldo del usuario suscrito
                // $subscription->user->decrement('saldo', $amountFactured);

                // Registrar la transacción
                $transaccion = new Transaction([
                    'amount' => $amountFactured,
                    'description' => 'Facturación de suscripción',
                    'user_id' => $subscription->user->id,
					'type' => 'send'
                ]);
                $transaccion->save();

                // Realizar el pago al dueño del plan
                $plan->user->increment('saldo', $amountFactured);
				$transaccionPayment = new Transaction([
                    'amount' => $amountFactured,
                    'description' => 'Facturación de suscripción',
                    'user_id' => $subscription->user->id,
					'type' => 'receive'
                ]);
                $transaccionPayment->save();
                // Marcar la suscripción como facturada
                $subscription->status = 'facturado';
                $subscription->save();
            }
        }

        $this->info('Facturación de suscripciones completada con éxito.');
    }
}
