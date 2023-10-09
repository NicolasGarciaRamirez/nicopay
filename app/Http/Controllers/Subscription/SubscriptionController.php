<?php

namespace App\Http\Controllers\Subscription;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Subscription\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        // Obtener todas las suscripciones
        $subscriptions = Subscription::all();

        return Inertia::render('Subscriptions/Index', [
            'subscriptions' => $subscriptions,
        ]);
    }

    public function create()
    {
        // Muestra el formulario para crear una nueva suscripción
        return Inertia::render('Subscriptions/Create');
    }

    public function store(Request $request)
    {
        try {
            // Valida los datos del formulario
            $request->validate([
                'user_id' => 'required|integer',
                'plan_id' => 'required|integer',
                'status' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                // Agrega otras validaciones según tus necesidades
            ]);

            // Crea una nueva suscripción
            $subscription = Subscription::create([
                'user_id' => $request->input('user_id'),
                'plan_id' => $request->input('plan_id'),
                'status' => $request->input('status'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                // Completa con otros campos de la suscripción
            ]);

            return response()->json($subscription, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la suscripción'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit($id)
    {
        // Muestra el formulario para editar una suscripción
        $subscription = Subscription::find($id);

        return Inertia::render('Subscriptions/Edit', [
            'subscription' => $subscription,
        ]);
    }

    public function update(Request $request, $id)
    {
		try {
            // Valida los datos del formulario
            $request->validate([
                'user_id' => 'required|integer',
                'plan_id' => 'required|integer',
                'status' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                // Agrega otras validaciones según tus necesidades
            ]);

            // Crea una nueva suscripción
            $subscription = Subscription::create([
                'user_id' => $request->input('user_id'),
                'plan_id' => $request->input('plan_id'),
                'status' => $request->input('status'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                // Completa con otros campos de la suscripción
            ]);

            return response()->json($subscription, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la suscripción'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        // Elimina una suscripción
        $subscription = Subscription::find($id);
        $subscription->delete();

        return redirect()->route('subscriptions.index')->with('success', 'Suscripción eliminada con éxito.');
    }
}
