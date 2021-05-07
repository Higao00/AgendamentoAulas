<?php

namespace App\Http\Controllers;

use App\Models\HorarioAulas;
use App\Models\User;
use Illuminate\Http\Request;

class HorarioAulasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = HorarioAulas::all();

        if ($horarios) {
            $result['status'] = 'success';

            foreach ($horarios as $key => $horario) {
                $aluno = $horario->user()->get();
                $materia = $horario->materia()->get();
                $result['dados'][$key] = $horario;

                if ($aluno) {
                    $result['dados'][$key]['dados_user'] = $aluno;
                }

                if ($materia) {
                    $result['dados'][$key]['materia'] = $materia;
                }
            }
        } else {
            $result['status'] = 'error';
            $result['message'] = "Aulas não encontrada!!";
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

            $timestamp = strtotime($data['hora_fim']) - 60 * 01;
            $horaFim = strftime('%H:%M', $timestamp);

            $timestamp = strtotime($data['hora_inicio']) + 60 * 01;
            $horaMais = strftime('%H:%M', $timestamp);

            $horarioExiste = HorarioAulas::query()
                ->where('user_id', '=', $data['user_id'])
                ->where('data', '=', $data['data'])
                ->where('hora_inicio', '<=', $horaFim)
                ->where('hora_fim', '>=', $horaMais)
                ->get();

            if (count($horarioExiste) == 0) {
                $horarioAula =  HorarioAulas::create([
                    'user_id' => $data['user_id'],
                    'materia_id' => $data['materia_id'],
                    'data' => $data['data'],
                    'hora_inicio' => $data['hora_inicio'],
                    'hora_fim' => $data['hora_fim'],
                ]);

                $auxHorario = json_decode(json_encode($horarioAula));
                $horarios = HorarioAulas::find($auxHorario->id);

                $aluno = $horarios->user()->get();
                $materia = $horarios->materia()->get();
                $result['dados'] = $horarios;
                $result['dados']['dados_user'] = $aluno;
                $result['dados']['materia'] = $materia;


                $result['status'] = 'success';
                $result['message'] = "Horario de aula inserido com sucesso!!";
            } else {
                $result['status'] = 'error';
                $result['message'] = "Professor já cadastrado neste horario!!";
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
        $horarioAula = HorarioAulas::find($id);

        if ($horarioAula != null) {
            $result['status'] = 'success';
            $result['dados'] = $horarioAula;
        } else {
            $result['status'] = 'error';
            $result['massage'] = 'Horario não existe!!';
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

            $horaAula = HorarioAulas::find($id);

            if ($horaAula != null) {
                $horaAula->hora_inicio = '00:00';
                $horaAula->hora_fim = '00:00';
                $horaAula->save();

                $timestamp = strtotime($data['hora_fim']) - 60 * 01;
                $horaFim = strftime('%H:%M', $timestamp);

                $timestamp = strtotime($data['hora_inicio']) + 60 * 01;
                $horaMais = strftime('%H:%M', $timestamp);

                $horarioExiste = HorarioAulas::query()
                    ->where('user_id', '=', $data['user_id'])
                    ->where('data', '=', $data['data'])
                    ->where('hora_inicio', '<=', $horaFim)
                    ->where('hora_fim', '>=', $horaMais)
                    ->get();


                if (count($horarioExiste) == 0) {
                    $horaAula = HorarioAulas::find($id);
                    $horaAula->user_id = $data['user_id'];
                    $horaAula->materia_id = $data['materia_id'];
                    $horaAula->data = $data['data'];
                    $horaAula->hora_inicio = $data['hora_inicio'];
                    $horaAula->hora_fim = $data['hora_fim'];
                    $horaAula->save();

                    $result['status'] = 'success';
                    $result['message'] = "Horario de aula alterado com sucesso!!";
                    $result['dados'] = $horaAula;
                } else {
                    $result['status'] = 'error';
                    $result['message'] = "Horario Aula já cadastrado!!";
                }
            } else {
                $result['status'] = 'error';
                $result['message'] = "Horario Aula não existe!!";
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

            $horarioAula = HorarioAulas::find($id);

            if ($horarioAula != null) {
                HorarioAulas::destroy($id);
                $result['status'] = 'success';
                $result['message'] = "Hora Aula deletados com sucesso!!";
            } else {
                $result['status'] = 'error';
                $result['message'] = "Hora Aula não existe!!";
            }
        } else {
            $result['status'] = 'error';
            $result['message'] = "Token Invalido!!";
        }

        echo json_encode($result);
    }
}
