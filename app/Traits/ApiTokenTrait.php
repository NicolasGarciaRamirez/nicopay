<?php
namespace App\Traits;

use App\Models\Cards\ApiToken;
use Illuminate\Support\Facades\Crypt;

trait ApiTokenTrait 
{
	public function createApiTokens($name, $user)
	{
		$apiKey = bin2hex(random_bytes(16)); // Genera una cadena hexadecimal de 32 caracteres
        $apiSecret = bin2hex(random_bytes(32)); // Genera una cadena hexadecimal de 64 caracteres

		// Crea y guarda el token API
		$apiToken = new ApiToken();
		$apiToken->name = $name;
		$apiToken->key_public = $apiKey;
		$apiToken->key_secret = Crypt::encryptString($apiSecret);
		$user()->apiToken()->save($apiToken);

		return $apiToken;
	}
}