<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Plan;
use App\Models\Meta;
use App\Models\Indicador;
use App\Models\Seguimiento;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Datos para Tarjetas Informativas Rápidas (Bloque Original)
        $totalProyectos   = DB::table('proyectos')->count();
        $totalPlanes      = DB::table('plans')->count();
        $totalMetas       = DB::table('metas')->count();
        $totalIndicadores = DB::table('indicadores')->count();

        // 1.2. Datos para Nuevas Tarjetas Analíticas (Bloque Expandido)
        // Sumatoria del presupuesto fiscalizado en integraciones financieras
        $totalPresupuesto = DB::table('integracion_finanzas')->sum('montoPresupuesto') ?? 0;
        
        // Conteos de impacto, evidencias y seguridad
        $totalOds         = DB::table('o_d_s')->count();
        $totalDocumentos  = DB::table('documentos')->count();
        $totalAuditorias  = DB::table('auditorias')->count();

        // 2. Gráfico 1: Proyectos por Estado (Agrupación)
        $proyectosPorEstado = DB::table('proyectos')
            ->select('estadoProyecto', DB::raw('count(*) as total'))
            ->groupBy('estadoProyecto')
            ->get();

        // Formatear datos para pasárselos a Chart.js de forma directa
        $estadosLabels  = $proyectosPorEstado->pluck('estadoProyecto')->toArray();
        $estadosValores = $proyectosPorEstado->pluck('total')->toArray();

        // 3. Gráfico 2: Avances en los últimos Seguimientos
        $ultimosSeguimientos = DB::table('seguimientos')
            ->join('proyectos', 'seguimientos.proyecto_id', '=', 'proyectos.id')
            ->select('proyectos.nombreProyecto', 'seguimientos.avance')
            ->orderBy('seguimientos.created_at', 'desc')
            ->take(6) // Mostramos solo los últimos 6 para no saturar el gráfico
            ->get();

        $seguimientosLabels  = $ultimosSeguimientos->pluck('nombreProyecto')->toArray();
        $seguimientosAvances = $ultimosSeguimientos->pluck('avance')->toArray();

        // Retornar todas las variables unificadas a la vista dashboard
        return view('dashboard', compact(
            'totalProyectos', 
            'totalPlanes', 
            'totalMetas', 
            'totalIndicadores',
            'totalPresupuesto',
            'totalOds',
            'totalDocumentos',
            'totalAuditorias',
            'estadosLabels',
            'estadosValores',
            'seguimientosLabels',
            'seguimientosAvances'
        ));
    }
}