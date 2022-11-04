<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $listaCategoria=Categoria::all();
        return response()->json($listaCategoria);
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
            "Tipo"=> ['string','required'],
            "Concepto"=> ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        Categoria::create($request->json()->all());
        $categoria = new Categoria($request->json()->all());
        return response()->json($categoria);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $categoria =Categoria::find($id);
        if($categoria==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($categoria);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $categoria =Categoria::find($id);
        if($categoria==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        if($request->method()=='PUT'){
            $validator = Validator::make($request->json()->all(),[
                "Tipo"=> ['string'],
                "Concepto"=> ['required'],
            ]);
        }else{
            $validator = Validator::make($request->json()->all(),[
                "Tipo"=> ['string'],
                "Concepto"=> ['required'],
            ]);
        }
        if($validator->fails()){
            return response()->json($validator->messages(),Response::HTTP_BAD_REQUEST);
        }
        $categoria->fill($request->json()->all());
        $categoria->save();
        return response()->json($categoria);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $categoria =Categoria::find($id);
        if($categoria==null){
            return response()->json(array("message"=> "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $categoria->delete();
        return response()->json(['success'=>true]);
    }
}
