<?php

namespace App\Http\Controllers;
use App\Comida;
use App\Comida_Ingrediente;
use Illuminate\Http\Request;
use App\Http\Requests\ComidaRequest;


class ComidaController extends Controller
{
    public function __construct()
  	{
      $this->middleware('auth');
  	}

    public function index()
    {
    	$comidas = Comida::latest('created_at')->get();

    	return view('comida.index', compact('comidas'));
    }

  	public function show($id)
  	{
  		$comida = Comida::findOrFail($id);

  		return view('comida.show', compact('comida'));
  	}

    public function create()
    {
      $ingredientes = \App\Ingrediente::all(); 
      return view('comida.create', ['ingredientes' => $ingredientes]);
    }

    /*la validación es disparada antes de que se cree el comida*/
    public function store(ComidaRequest $request)
    {
      $nuevaComida = Comida::create($request->all());

      $ingredientes = $request->input('ingrediente_id'); // ESTO VA A SER UN ARRAY CON TODOS LOS IDS! 
      $cantidades = $request->input('cantidad');

      foreach($ingredientes as $key => $in_id)
      {
        $ingrediente_comida = new Comida_Ingrediente(['id_ingrediente' => $in_id,
                                                      'id_comida' => $nuevaComida->id, 
                                                      'cantidad'=> $cantidades[$key]]);
        $ingrediente_comida->save();
      }
   
      return redirect('comida');
    }

    public function edit($id)
    {
      $comida = Comida::findOrFail($id);
      return view('comida.edit', compact('comida'));
    }

    public function update($id, ComidaRequest $request)
    {
      $comida = Comida::findOrFail($id);

      $comida->update($request->all());
      return redirect('comida');
    }
}
