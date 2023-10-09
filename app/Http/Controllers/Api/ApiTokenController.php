<?php

namespace App\Http\Controllers\api;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Traits\ApiTokenTrait;
use App\Models\Cards\ApiToken;
use App\Http\Controllers\Controller;

class ApiTokenController extends Controller
{
	use ApiTokenTrait;
	public function index()
    {
        // Recupera todos los tokens API
        $user = auth()->user()->load('apiToken','balance');
        // Retorna una vista que muestra la lista de tokens API
		return Inertia::render('ApiTokens/Index', ['apiToken' => $user->apiToken, 'user' => $user]);
    }

    public function create()
    {
        // Retorna una vista para crear un nuevo token API
		return Inertia::render('ApiTokens/Create');
    }

    public function store(Request $request)
    {
        // Valida y almacena el nuevo token API en la base de datos
        $request->validate([
            'name' => 'required|string|max:255',
            // Otros campos de validación si es necesario
        ]);

		$this->createApiTokens('apiToken', auth()->user());

        // Redirige a la lista de tokens API con un mensaje de éxito
        return Inertia::render('ApiTokens/Index');
		// ->with('success', 'Token API creado con éxito');
    }

    public function edit(ApiToken $apiToken)
    {
        // Retorna una vista para editar el token API
        return view('api-tokens.edit', compact('apiToken'));
    }

    public function update(Request $request, ApiToken $apiToken)
    {
        // Valida y actualiza el token API en la base de datos
        $request->validate([
            'name' => 'required|string|max:255',
            // Otros campos de validación si es necesario
        ]);

        // Actualiza el token API
        $apiToken->update([
            'name' => $request->input('name'),
            // Otros campos si es necesario
        ]);

        // Redirige a la lista de tokens API con un mensaje de éxito
        return redirect()->route('api-tokens.index')->with('success', 'Token API actualizado con éxito');
    }

    public function destroy(ApiToken $apiToken)
    {
        // Elimina el token API de la base de datos
        $apiToken->delete();

        // Redirige a la lista de tokens API con un mensaje de éxito
        return redirect()->route('api-tokens.index')->with('success', 'Token API eliminado con éxito');
    }
}
