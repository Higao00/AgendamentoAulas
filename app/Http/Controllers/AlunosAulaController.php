<?php

namespace App\Http\Controllers;

use App\Models\AlunosAulas;
use App\Models\HorarioAulas;
use App\Models\User;
use Illuminate\Http\Request;

class AlunosAulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horas = AlunosAulas::all();

        if ($horas) {
            $result['status'] = 'success';

            foreach ($horas as $key => $hora) {
                $aluno = $hora->user()->get();
                $dado_aula = $hora->horarioAula()->get();
                $result[$key]['dados'] = $hora;

                if ($aluno) {
                    $result[$key]['dados']['dados_user'] = $aluno;
                }

                if ($dado_aula) {
                    $result[$key]['dados']['dados_aulas'] = $dado_aula;
                }
            }
        } else {
            $result['status'] = 'error';
            $result['message'] = "Não a horario cadastrado!!";
        }

        echo json_encode($result);
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
        $data = $request->all();

        if ($data['token'] == '123456789123456789123456789') {

            if (User::find($data['user_id'])) {

                if (HorarioAulas::find($data['hora_id'])) {
                    $aluno = AlunosAulas::create([
                        'hora_id' => $data['hora_id'],
                        'user_id' => $data['user_id'],
                        'status' => $data['status'],
                    ]);

                    $result['status'] = 'success';
                    $result['message'] = "Aluno inserido com sucesso na aula!!";
                    $result['dados'] = $aluno;
                } else {
                    $result['status'] = 'error';
                    $result['message'] = "Horario aula não existe, ou não disponivel!!";
                }
            } else {
                $result['status'] = 'error';
                $result['message'] = "Aluno não existe!!";
            }
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
        $horas = AlunosAulas::find($id);

        $dados_user = $horas->user()->get();
        $dados_aulas = $horas->horarioAula()->get();

        if ($horas != null) {
            $result['status'] = 'success';
            $result['dados_user'] = $dados_user;
            $result['dados_aulas'] = $dados_aulas;
        } else {
            $result['status'] = 'error';
            $result['massage'] = 'Aluno não existe!!';
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
            if ($aluno_aula = AlunosAulas::find($id)) {
                if (User::find($data['user_id'])) {
                    if (HorarioAulas::find($data['hora_id'])) {
                        $aluno_aula->hora_id = $data['hora_id'];
                        $aluno_aula->user_id = $data['user_id'];
                        $aluno_aula->status = $data['status'];

                        $aluno_aula->save();

                        $result['status'] = 'success';
                        $result['message'] = "Aluno aula editado com sucesso!!";
                        $result['dados'] = $aluno_aula;
                    } else {
                        $result['status'] = 'error';
                        $result['message'] = "Horario informado invalido!!";
                    }
                } else {
                    $result['status'] = 'error';
                    $result['message'] = "Usuario invalido!!";
                }
            } else {
                $result['status'] = 'error';
                $result['message'] = "Não existe a chave informada!!";
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

            if (AlunosAulas::find($id)) {
                AlunosAulas::destroy($id);
                $result['status'] = 'success';
                $result['message'] = "Usuario deletado da aula com sucesso!!";
            } else {
                $result['status'] = 'error';
                $result['message'] = "Usuario não existe na aula!!";
            }
        } else {
            $result['status'] = 'error';
            $result['message'] = "Token Invalido!!";
        }

        echo json_encode($result);
    }
}
