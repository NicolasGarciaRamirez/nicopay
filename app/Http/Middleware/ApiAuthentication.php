<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cards\ApiToken;
use Illuminate\Http\Request;

class ApiAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtén el API Key del encabezado
        $apiKey = $request->header('X-API-Key');

        // Encuentra al cliente en la base de datos por su API Key
        $cliente = ApiToken::where('api_key', $apiKey)->first();

        if (!$cliente) {
            return response()->json(['error' => 'API Key no válido'], 401);
        }

        // Verifica la firma de la solicitud
        $apiSecret = decrypt($cliente->api_secret);
        $firmaCliente = $request->header('X-API-Signature');
        if (!$this->verificarFirma($apiSecret, $request, $firmaCliente)) {
            return response()->json(['error' => 'Firma inválida'], 401);
        }

        // Asigna el cliente autenticado a la solicitud
        $request->attributes->add(['cliente' => $cliente]);

        return $next($request);    
    }
	private function verificarFirma($apiSecret, $request, $firmaCliente) {
        // Obtén los datos de la solicitud (cuerpo de la solicitud y encabezados)
		$requestData = $request->getContent() . http_build_query($request->header());

		// Calcula la firma esperada utilizando HMAC-SHA256
		$firmaEsperada = hash_hmac('sha256', $requestData, $apiSecret);

		// Compara la firma proporcionada por el cliente con la firma esperada
		return hash_equals($firmaCliente, $firmaEsperada);
    }
}
