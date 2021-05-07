<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        $result['status'] = 'success';
        $result['dados'] = $users;
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
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'sobre_nome' => ['required', 'string', 'max:255'],
                'documento' => ['required', 'string', 'min:12', 'max:12'],
                'status' => ['max:4'],
                'data_nacimento' => ['required', 'date', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            if ($validator->fails()) {
                $result['status'] = 'error';
                $result['message'] = "Error, usuario não cadastrado!!";
                $result['dados'] = $validator->errors();
            } else {
                $user =  User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'sobre_nome' => $data['sobre_nome'],
                    'documento' => $data['documento'],
                    'status' => $data['status'],
                    'data_nacimento' => $data['data_nacimento'],
                    'password' => Hash::make($data['password']),
                ]);

                $result['status'] = 'success';
                $result['message'] = "Usuario inserido com sucesso!!";
                $result['dados'] = $user;
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
        $user = User::find($id);

        if ($user != null) {
            $result['status'] = 'success';
            $result['dados'] = $user;
        } else {
            $result['status'] = 'error';
            $result['massage'] = 'Usuario não existe!!';
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

            $user = User::find($id);

            if ($user) {
                $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'sobre_nome' => ['required', 'string', 'max:255'],
                    'documento' => ['required', 'string', 'min:12', 'max:12'],
                    'status' => ['max:4'],
                    'data_nacimento' => ['required', 'date', 'max:50'],
                ]);

                if ($validator->fails()) {
                    $result['status'] = 'error';
                    $result['message'] = "Error, usuario não alterado!!";
                    $result['dados'] = $validator->errors();
                } else {

                    $user->name = $data['name'];
                    $user->sobre_nome = $data['sobre_nome'];
                    $user->documento = $data['documento'];
                    $user->status = $data['status'];
                    $user->data_nacimento = $data['data_nacimento'];

                    $user->save();

                    $result['status'] = 'success';
                    $result['message'] = "Usuario inserido com sucesso!!";
                    $result['dados'] = $user;
                }
            } else {
                $result['status'] = 'error';
                $result['message'] = "Usuario não existe!!";
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

            $user = User::find($id);

            if ($user != null) {
                User::destroy($id);
                $result['status'] = 'success';
                $result['message'] = "Usuario deletado com sucesso!!";
            } else {
                $result['status'] = 'error';
                $result['message'] = "Usuario não existe!!";
            }
        } else {
            $result['status'] = 'error';
            $result['message'] = "Token Invalido!!";
        }

        echo json_encode($result);
    }
}
