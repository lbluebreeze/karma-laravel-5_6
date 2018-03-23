<?php

namespace App\Http\Controllers;

use App\Concursante;
use Illuminate\Http\Request;
use App\Exports\ConcursanteExport;

class ConcursanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!session('Concursante'))
        {
            $model = new Concursante();
            session(['Concursante' => $model]);
        }

        $ganador = Concursante::where(['ganador' => true])->first();
        if ($ganador)
        {
            return view('ganador', ['model' => $ganador]);
        }

        $search = Concursante::all();
        if ($search->count() >= 5)
        {
            $rand_idx = array_rand($search->toArray());
            $ganador = $search->get($rand_idx);
            $ganador->ganador = '1';
            $ganador->save();
            return view('ganador', ['model' => $ganador]);
        }

        return view('form', ['model' => session('Concursante')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $c = session('Concursante');
        $c->fill($request->except('_token'));
        if ($c->validate($c->toArray()))
        {
            $count = Concursante::where('cedula', $c->cedula)->count();
            if ($count > 0)
            {
                return redirect()->back()->with(['msj' => ['alert alert-danger', 'Su número de cédula ya está en nuestra base de datos. Gracias nuevamente por haberse registrado.']]);
            }

            $c->save();
            $request->session()->forget('Concursante');
            $request->session()->put('Concursante', new Concursante());
            return redirect()->back()->with(['msj' => ['alert alert-success', '¡Gracias por registrarse!']]);
        }
        else
        {
            return redirect()->back()->with(['errors' => $c->errors()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportar() 
    {
        $excel = (new ConcursanteExport)->download();
        return $excel;
    }
}
