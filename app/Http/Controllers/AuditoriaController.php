<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;

class AuditoriaController extends Controller
{
    //
    public function index()
    {
        $auditorias = Auditoria::latest()->get();

        return view('auditorias.index', compact('auditorias'));
    }
    public function exportPdf()
{
    // Recuperamos las pistas de auditoría ordenadas por el evento más reciente
    $auditorias = \App\Models\Auditoria::with('user')->orderBy('created_at', 'desc')->get();

    // Renderizamos la vista blade dedicada y la descargamos
    $html = view('auditorias.pdf', compact('auditorias'))->render();
    
    // Si usas el motor de renderizado del sistema, se procesa directamente la variable $html
    return response($html)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="Reporte_Auditoria_SIPeIP.pdf"');
}

}
