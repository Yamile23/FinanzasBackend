<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
class CuentaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $listaCuentas=Cuenta::all();
        return response()->json($listaCuentas);
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
            "Nombre"=> ['string','required'],
            "Saldo"=> ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        Cuenta::create($request->json()->all());
        $cuenta = new Cuenta($request->json()->all());
        return response()->json($cuenta);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $cuenta =Cuenta::find($id);
        if($cuenta==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($cuenta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $cuenta =Cuenta::find($id);
        if($cuenta==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        if($request->method()=='PUT'){
            $validator = Validator::make($request->json()->all(),[
                "Nombre"=> ['string'],
                "Saldo"=> ['required'],
            ]);
        }else{
            $validator = Validator::make($request->json()->all(),[
                "Nombre"=> ['string'],
                "Saldo"=> ['required'],
            ]);
        }
        if($validator->fails()){
            return response()->json($validator->messages(),Response::HTTP_BAD_REQUEST);
        }
        $cuenta->fill($request->json()->all());
        $cuenta->save();
        return response()->json($cuenta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $cuenta =Cuenta::find($id);
        if($cuenta==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $cuenta->delete();
        return response()->json(['success'=>true]);
    }
    public function Saldo(){
        $saldo=Cuenta::sum('Saldo');
        return response()->json($saldo);
    }
}
