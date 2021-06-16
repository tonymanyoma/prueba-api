<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Viaje;
use Illuminate\Http\Request;
use DB;
use Storage;

class ClienteController extends Controller
{


    public function getClientes(Request $request)
    {

        $query = trim($request->get('searchText'));

        $clientes = DB::table('clientes')->where('email','LIKE','%'.$query.'%')
                                       ->orwhere('nombre','LIKE','%'.$query.'%')
                                       ->orwhere('apellidos','LIKE','%'.$query.'%')
                                       ->paginate(10);
        return $clientes;
           
           

    }


    public function createCliente(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);

        //validar si el email ya se encuentra registrado

        $existCliente = Cliente::where('email', '=', $request->email)->first();

        if( empty($existCliente) ){

            $cliente = new Cliente();

            $cliente->email = $request->email;
            $cliente->nombre = $request->nombre;
            $cliente->apellidos = $request->apellidos;
            $cliente->telefono = $request->telefono;
            $cliente->direccion = $request->direccion;

        if( $request->foto ){
                
                $file = $request->file('foto');
                $name = time()."_".$file->getClientOriginalName();

                Storage::disk('local')->put($name, \File::get($file));

                $cliente->foto = $name;

        }

        $cliente->save();
            
        
            return response()->json([
                'status' => 'success',
                'msg' => 'cliente creado con éxito',
            ],200);


        }else{

            return response()->json([
                'status' => 'error',
                'msg' => 'el email ya se encuentra registrado',
            ],200);
        }

        
    }

    public function updateCliente(Request $request, $id)
    {


            $cliente = Cliente::find($id);

            $cliente->email = $request->email;
            $cliente->nombre = $request->nombre;
            $cliente->apellidos = $request->apellidos;
            $cliente->telefono = $request->telefono;
            $cliente->direccion = $request->direccion;

        if( $request->foto ){
                
                $file = $request->file('foto');
                $name = time()."_".$file->getClientOriginalName();

                Storage::disk('local')->put($name, \File::get($file));

                $cliente->foto = $name;

        }

        $cliente->save();
            
        
            return response()->json([
                'status' => 'success',
                'msg' => 'cliente actualizado con éxito',
            ],200);

        
    }


    public function deleteCliente(Request $request, $email)
    {          
            //eliminar viajes
            $viajes = Viaje::where('email_cliente', $email)->delete();

            //eliminar foto
            $existCliente = Cliente::where('email', '=', $request->email)->first();

            Storage::disk('local')->delete($existCliente->foto); 

            //eliminar cliente
            $cliente = Cliente::where('email', $email)->delete();



            return response()->json([
                'status' => 'success',
                'msg' => 'cliente eliminado con éxito',
            ],200);

       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       
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
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
