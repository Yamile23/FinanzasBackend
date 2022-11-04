<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $listaMovimiento=Movimiento::all();
        return response()->json($listaMovimiento);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(),[
            "fecha"=>['date','required'],
            "Monto"=> ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        Movimiento::create($request->json()->all());
        $movimiento = new Movimiento($request->json()->all());
        return response()->json($movimiento);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movimiento  $movimiento
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $movimiento =Movimiento::find($id);
        if($movimiento==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($movimiento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimiento $movimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movimiento  $movimiento
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $movimiento =Movimiento::find($id);
        if($movimiento==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        if($request->method()=='PUT'){
            $validator = Validator::make($request->json()->all(),[
                "fecha"=>['date'],
                "Monto"=> ['integer'],
            ]);
        }else{
            $validator = Validator::make($request->json()->all(),[
                "fecha"=>['date'],
                "Monto"=> ['integer'],
            ]);
        }
        if($validator->fails()){
            return response()->json($validator->messages(),Response::HTTP_BAD_REQUEST);
        }
        $movimiento->fill($request->json()->all());
        $movimiento->save();
        return response()->json($movimiento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movimiento  $movimiento
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $movimiento =Movimiento::find($id);
        if($movimiento==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $movimiento->delete();
        return response()->json(['success'=>true]);
    }

    public function DetalleMovimiento(){
        $Detalle=Movimiento::select('movimientos.id','movimientos.fecha','categorias.Concepto','movimientos.Monto',
            'cuentas.Nombre','tipo_mons.Simbolo',DB::raw('(select cuentas.Nombre from cuentas where cuentas.id=movimientos.cuentaDestino_id) as Destino'))
            ->leftjoin('cuentas','cuentas.id','=','movimientos.cuentaOrigen_id')
            ->leftjoin('categorias','categorias.id','=','movimientos.categoria_id')
            ->leftjoin('tipo_mons','tipo_mons.id','=','movimientos.tipo_id')
            ->get();
        return response()->json($Detalle);
    }
    public function DetalleCuenta(Request $request)
    {
        $validator = Validator::make($request->json()->all(),[
            "cuenta"=> ['string']
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),Response::HTTP_BAD_REQUEST);
        }
        $Detalle=Movimiento::select('movimientos.id','movimientos.fecha','categorias.Concepto','movimientos.Monto',
            'cuentas.id as id_origen','cuentas.Nombre','tipo_mons.Simbolo',
            DB::raw('(select cuentas.id from cuentas where cuentas.id=movimientos.cuentaDestino_id) as id_Destino'),
            DB::raw('(select cuentas.Nombre from cuentas where cuentas.id=movimientos.cuentaDestino_id) as Destino'))
            ->leftjoin('cuentas','cuentas.id','=','movimientos.cuentaOrigen_id')
            ->leftjoin('categorias','categorias.id','=','movimientos.categoria_id')
            ->leftjoin('tipo_mons','tipo_mons.id','=','movimientos.tipo_id')
            ->where('cuentas.id','=',$request->cuenta)
            ->orWhere(DB::raw('(select cuentas.id from cuentas where cuentas.id=movimientos.cuentaDestino_id)'),
                '=',$request->cuenta)
            ->get();
        return response()->json($Detalle);
    }

}
