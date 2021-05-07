<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = Materias::all();

        $result['status'] = 'success';
        $result['dados'] = $materias;
        echo json_encode($result);
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
        $data = $request->all();

        if ($data['token'] == '123456789123456789123456789') {

            $materia = Materias::create([
                'nome' => $data['nome'],
                'tipo_materia' => $data['tipo_materia']
            ]);

            $result['status'] = 'success';
            $result['message'] = "Materia inserida com sucesso!!";
            $result['dados'] = $materia;
        } else {
            $result['status'] = 'error';
            $result['message'] = "Token Invalido!!";
        }

        echo json_encode($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materia = Materias::find($id);

        if ($materia != null) {
            $result['status'] = 'success';
            $result['dados'] = $materia;
        } else {
            $result['status'] = 'error';
            $result['massage'] = 'Materia não existe!!';
        }

        echo json_encode($result);
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
        $data = $request->all();

        if ($data['token'] == '123456789123456789123456789') {
            $materia = Materias::find($id);

            if ($materia != null) {
                $materia->nome = $data['nome'];
                $materia->tipo_materia = $data['tipo_materia'];
                $materia->save();

                $result['status'] = 'success';
                $result['message'] = "Matria alterada com sucesso!!";
                $result['dados'] = $materia;
            } else {
                $result['status'] = 'error';
                $result['message'] = "Materia não existe!!";
            }
        } else {
            $result['status'] = 'error';
            $result['message'] = "Token Invalido!!";
        }

        echo json_encode($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        if ($data['token'] == '123456789123456789123456789') {

            $materia = Materias::find($id);

            if ($materia != null) {
                Materias::destroy($id);
                $result['status'] = 'success';
                $result['message'] = "Materia deletada com sucesso!!";
            } else {
                $result['status'] = 'error';
                $result['message'] = "Materia não existe!!";
            }
        } else {
            $result['status'] = 'error';
            $result['message'] = "Token Invalido!!";
        }

        echo json_encode($result);
    }
}
