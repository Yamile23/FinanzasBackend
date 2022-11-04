<?php

namespace App\Http\Controllers;

use App\Models\TipoMon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TipoMonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $listatipo=TipoMon::all();
        return response()->json($listatipo);
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
             "Simbolo"=> ['string']
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        TipoMon::create($request->json()->all());
        $Tipo = new TipoMon($request->json()->all());
        return response()->json($Tipo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoMon  $tipoMon
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tipoMon =TipoMon::find($id);
        if($tipoMon==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($tipoMon);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoMon  $tipoMon
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoMon $tipoMon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoMon  $tipoMon
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $tipoMon =TipoMon::find($id);
        if($tipoMon==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        if($request->method()=='PUT'){
            $validator = Validator::make($request->json()->all(),[
                "Nombre"=> ['string'],
                "Simbolo"=> ['string']
            ]);
        }else{
            $validator = Validator::make($request->json()->all(),[
                "Nombre"=> ['string'],
                "Simbolo"=> ['string']
            ]);
        }
        if($validator->fails()){
            return response()->json($validator->messages(),Response::HTTP_BAD_REQUEST);
        }
        $tipoMon->fill($request->json()->all());
        $tipoMon->save();
        return response()->json($tipoMon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoMon  $tipoMon
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $tipoMon =TipoMon::find($id);
        if($tipoMon==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $tipoMon->delete();
        return response()->json(['success'=>true]);
    }
}
