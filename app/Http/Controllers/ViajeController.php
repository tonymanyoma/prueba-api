<?php

namespace App\Http\Controllers;

use App\Viaje;
use Illuminate\Http\Request;


class ViajeController extends Controller
{



    public function getViajes(Request $request)
    {


        $viajes = Viaje::all();

        return $viajes;
           
           

    }

    
    public function createViajes(Request $request)
    {

        $data = $request->getContent();


        $xml = simplexml_load_string($data);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);


        //return $array;

        foreach ($array as $value)
        {  


            $viaje = new Viaje();

            $viaje->email_cliente = $value['email'];
            $viaje->fecha_viaje =  $value['fecha'];
            $viaje->pais =  $value['pais'];
            $viaje->ciudad =  $value['ciudad'];

            $viaje ->save();

        }

        return response()->json([
            'status' => 'success',
            'msg' => 'listado de viajes agregados con éxito',
        ],200);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function show(Viaje $viaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Viaje $viaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Viaje $viaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Viaje $viaje)
    {
        //
    }
}
