<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$professionals = Professional::with('availabilityDays')->get();
        $professionals = Professional::all();
        return response()->json($professionals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'crm' => 'required|string|max:50|unique:professionals,crm',
            'contact' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:professionals,email',
            'hire_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'status' => 'nullable|boolean'
        ]);


        $professional = Professional::create($validated);
       
        /*
        if ($request->has('daysOfWeek')) {
            foreach ($request->daysOfWeek as $day) {
                AvailabilityDay::create([
                    'professional_id' => $professional->id,
                    'dia_semana' => $day
                ]);
            }
        }*/

        return response()->json($professional, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $professional = Professional::find($id);

        if (!$professional) {
            return response()->json(['message' => 'Profissional não encontrado'], 404);
        }

        return response()->json($professional);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'especialidade' => 'required|string|max:255',
            'crm' => 'required|string|max:50|unique:professionals,crm,' . $id,
            'contato' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:professionals,email,' . $id,
            'data_contratacao' => 'nullable|date',
            'inicio_atendimento' => 'nullable|date_format:H:i',
            'fim_atendimento' => 'nullable|date_format:H:i',
            'status' => 'required|boolean',
            'daysOfWeek' => 'array',
            'daysOfWeek.*' => 'string|max:20'
        ]);

        $professional = Professional::findOrFail($id);

        $professional->update($validated);

        if ($request->has('daysOfWeek')) {
            // Remove os dias de atendimento existentes
            AvailabilityDay::where('professional_id', $professional->id)->delete();
            
            // Adiciona os novos dias de atendimento
            foreach ($request->daysOfWeek as $day) {
                AvailabilityDay::create([
                    'professional_id' => $professional->id,
                    'dia_semana' => $day
                ]);
            }
        }

        return response()->json($professional);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $professional = Professional::findOrFail($id);

        $professional->delete();

        return response()->json(['message' => 'Professional deleted successfully']);
    }
}
