<?php
namespace App\Http\Controllers;
use App\Models\Plan;
use App\Models\Entidad;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $planes = Plan :: with('entidad')->get();
        return view('planes.index', compact('planes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         $entidades = Entidad::all();
         return view('planes.create', compact('entidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'nombrePlan'=> 'required|string',
            'descripcionPlan'=> 'required|string',
            'estadoPlan'=> 'required|string',
            'fechaInicio'=> 'required|date',
            'fechaFin' => 'required|date',
            'entidad_id' => 'required|integer',
        ]);
        Plan::create($request->all());
        return redirect()->route('planes.index')->with('success',"Plan creada satisfactoriamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $plan = Plan::with('entidad')->find($id);

        if (!$plan) {
            return response()->json(['error' => 'Plan no encontrado'], 404);
        }

        return response()->json([
            'id' => $plan->id,
            'nombrePlan' => $plan->nombrePlan,
            'descripcionPlan' => $plan->descripcionPlan,
            'estadoPlan' => $plan->estadoPlan,
            'fechaInicio' => $plan->fechaInicio,
            'fechaFin' => $plan->fechaFin,
            'entidad' => $plan->entidad ? [
                'nombreEntidad' => $plan->entidad->nombreEntidad,
                'tipoEntidad' => $plan->entidad->tipoEntidad,
                'direccionEntidad' => $plan->entidad->direccionEntidad,
            ] : null
        ]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $plan = Plan::findOrFail($id);
        $entidades = Entidad::all();
        return view('planes.edit',compact('plan','entidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $request->validate([
            'nombrePlan'=> 'required|string',
            'descripcionPlan'=> 'required|string',
            'estadoPlan'=> 'required|string',
            'fechaInicio'=> 'required|date',
            'fechaFin' => 'required|date',
            'entidad_id' => 'required|integer',
        ]);
         $planes = Plan::findOrFail($id);
         $planes->update($request->all());
         return redirect()->route('planes.index')->with('success',"Plan actualizada satisfactoriamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $planes = Plan::findOrFail($id);
        $planes->delete();
        return redirect()->route('planes.index')->with('success',"Plan eliminada satisfactoriamente");  
    }

     public function all()
    {
        return response()->json(
            Plan::select('id','nombrePlan')->get()
        );
    }




}
