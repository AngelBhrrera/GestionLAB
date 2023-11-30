<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
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
     * @param  \App\Models\HorasP  $horasP
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HorasP  $horasP
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $usuario = User::find($user);
        return view('/home',['opcion'=> 'auth.registerAdmin', 'nombre' => 'Modificar', 'dV'=> $usuario, 'ruta' => "/usuarios/{{$user}}"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HorasP  $horasP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $usuario =User::find($user);
        //print($request->get('codigo'));
        //print($request->get('descripcion'));
        //print($request->get('cantidad'));
        //print($request->get('precio'));

        $usuario->name = $request->get('name');
        $usuario->apellido = $request->get('apellido');
        $usuario->codigo = $request->get('codigo');
        $usuario->correo = $request->get('correo');
        $usuario->tipo = $request->get('tipo');



        $usuario->save();

        return redirect("/home");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HorasP  $horasP
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $articulo =User::find($user);
        $articulo ->delete();
        return redirect("/home");
    }
}
