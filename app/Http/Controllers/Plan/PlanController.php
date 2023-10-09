<?php

namespace App\Http\Controllers\Plan;

use App\Models\Plan;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response as HttpResponse;

class PlanController extends Controller
{
    public function save(Request $request)
	{
		// Valida los datos del formulario
		$request->validate([
			'name' => 'required|string|max:255',
			'price' => 'required|numeric|min:0',
			'description' => 'required|string',
			'frequency' => 'required|string', // Puedes personalizar la periodicidad según tus necesidades
		]);

		// Crea un nuevo plan
		$plan = new Plan([
			'name' => $request->input('name'),
			'price' => $request->input('price'),
			'description' => $request->input('description'),
			'frequency' => $request->input('frequency'),
		]);

		$plan->save();

		return response()->json([
			'message' => 'Plan creado con éxito',
			'plan' => $plan
		], HttpResponse::HTTP_OK);
	}

	public function index()
    {
        // Obtener todos los planes
        $plans = Plan::all();

        return Inertia::render('Plans/Index', [
            'plans' => $plans,
        ]);
    }

    public function create()
    {
        // Muestra el formulario para crear un nuevo plan
        return Inertia::render('Plans/Create');
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'frequency' => 'required|string',
            // Agrega otras validaciones según tus necesidades
        ]);

        // Crea un nuevo plan
        Plan::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'frequency' => $request->input('frequency'),
            // Completa con otros campos del plan
        ]);

        return redirect()->route('plans.index')->with('success', 'Plan creado con éxito.');
    }

    public function edit($id)
    {
        // Muestra el formulario para editar un plan
        $plan = Plan::find($id);

        return Inertia::render('Plans/Edit', [
            'plan' => $plan,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'frequency' => 'required|string',
            // Agrega otras validaciones según tus necesidades
        ]);

        // Actualiza el plan existente
        $plan = Plan::find($id);
        $plan->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'frequency' => $request->input('frequency'),
            // Completa con otros campos del plan
        ]);

        return redirect()->route('plans.index')->with('success', 'Plan actualizado con éxito.');
    }

    public function destroy($id)
    {
        // Elimina un plan
        $plan = Plan::find($id);
        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Plan eliminado con éxito.');
    }
}
