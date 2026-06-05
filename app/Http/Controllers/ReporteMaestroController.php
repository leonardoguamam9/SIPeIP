<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReporteMaestro;
use Illuminate\Support\Facades\Validator;
use Exception;

class ReporteMaestroController extends Controller
{
    /**
     * Guarda el registro consolidado desde la vista SIPeIP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // 1. Validación de los datos entrantes (Corregido a 'ods_id' que viene del JS)
        $validator = Validator::make($request->all(), [
            'entidad_id'  => 'nullable|integer',
            'pdn_id'      => 'nullable|integer',
            'ods_id'      => 'nullable|integer', // <-- CORREGIDO: Coincide con tu AJAX
            'plan_id'     => 'nullable|integer',
            'meta_id'     => 'nullable|integer',
            'programa_id' => 'nullable|integer',
            'proyecto_id' => 'required|integer', 
        ], [
            'proyecto_id.required' => 'El campo Proyecto es obligatorio para consolidar la información.',
            'integer'              => 'El identificador enviado no es un formato válido.'
        ]);

        // Si la validación falla, retornamos los errores con un código de estado 422
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            // 2. Persistencia de la información de manera segura
            $reporte = ReporteMaestro::create([
                'user_id'     => auth()->id(), 
                'entidad_id'  => $request->entidad_id,
                'pdn_id'      => $request->pdn_id,
                'o_d_s_id'    => $request->ods_id, // <-- MAPEADO: Columna física recibe el valor de la vista
                'plan_id'     => $request->plan_id,
                'meta_id'     => $request->meta_id,
                'programa_id' => $request->programa_id,
                'proyecto_id' => $request->proyecto_id,
            ]);

            // 3. Respuesta de éxito con estado 201 (Created)
            return response()->json([
                'success'    => true,
                'reporte_id' => $reporte->id,
                'message'    => 'Información del Panel Maestro guardada con éxito.'
            ], 201);

        }  catch (Exception $e) {
            // Forzamos a que nos devuelva el error real de la base de datos
            return response()->json([
                'success' => false,
                'message' => 'Error real de SQL: ' . $e->getMessage()
            ], 500);
        }
    }
}