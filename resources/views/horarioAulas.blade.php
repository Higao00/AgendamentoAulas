@extends('layouts.app')

@section('content')
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddAula">
                    <i class="bi bi-calendar-plus users"></i>Adicionar Aula
                </button>

                <button class="btn btn-primary" id="modelEditAula"><i class="bi bi-calendar-minus users"></i>Editar
                    Aula</button>

                <button class="btn btn-danger" id="deleteMateria"><i class="bi bi-calendar-x users"></i>Deletar
                    Aula</button>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped" id="tableAulaHorario">
                    <thead style="background: #b6d7ff">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome da Materia</th>
                            <th scope="col">Tipo da Materia</th>
                            <th scope="col">Nome Professor</th>
                            <th scope="col">Data da Aula</th>
                            <th scope="col">Horario Inicio</th>
                            <th scope="col">Horario Fim</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Add User --}}
    <div class="modal fade" id="modalAddAula" tabindex="-1" role="dialog" aria-labelledby="modalAddAula" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header imagens-modal">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Adicionar Aula</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body imagens-modal">
                    <form id="formAddAula" name="formAddAula">
                        <div class="form-group">
                            <label for="materiaAula" class="col-form-label text-white">Materia:</label>
                            <select name="materia_id" id="addAulaMateria" class="form-select form-control">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="professorAula" class="col-form-label text-white">Professor:</label>
                            <select name="user_id" id="addAulaProfessor" class="form-select form-control">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dataAula" class="col-form-label text-white">Data da Aula</label>
                            <input type="date" class="form-control" id="dataAula" name="data" required>
                        </div>

                        <div class="form-group">
                            <label for="horaInicioAula" class="col-form-label text-white">Hora Inicio</label>
                            <input type="time" class="form-control" id="horaInicio" name="hora_inicio" required>
                        </div>

                        <div class="form-group">
                            <label for="horaFimAula" class="col-form-label text-white">Hora Inicio</label>
                            <input type="time" class="form-control" id="horaFim" name="hora_fim" required>
                        </div>

                        <div class="form-group" hidden>
                            <input id="materiaToken" name="token" value="123456789123456789123456789">
                        </div>

                    </form>
                </div>
                <div class="modal-footer imagens-modal">
                    <button type="submit" class="btn btn-success" form="formAddAula">Cadastrar Materia</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit User --}}
    <div class="modal fade" id="modalEditAula" tabindex="-1" role="dialog" aria-labelledby="modalEditAula"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header imagens-modal">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body imagens-modal">
                    <form id="formEditAula" name="formEditAula">
                        <div class="form-group">
                            <label for="materiaAula" class="col-form-label text-white">Materia:</label>
                            <select name="materia_id" id="editAulaMateria" class="form-select form-control">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="professorAula" class="col-form-label text-white">Professor:</label>
                            <select name="user_id" id="editAulaProfessor" class="form-select form-control">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dataAula" class="col-form-label text-white">Data da Aula</label>
                            <input type="date" class="form-control" id="editDataAula" name="data" required>
                        </div>

                        <div class="form-group">
                            <label for="horaInicioAula" class="col-form-label text-white">Hora Inicio</label>
                            <input type="time" class="form-control" id="editHoraInicio" name="hora_inicio" required>
                        </div>

                        <div class="form-group">
                            <label for="horaFimAula" class="col-form-label text-white">Hora Inicio</label>
                            <input type="time" class="form-control" id="editHoraFim" name="hora_fim" required>
                        </div>

                        <div class="form-group" hidden>
                            <input id="materiaToken" name="token" value="123456789123456789123456789">
                        </div>

                    </form>
                </div>
                <div class="modal-footer imagens-modal">
                    <button type="submit" class="btn btn-success" form="formEditUser">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Listar Todas Aulas.
            $(function() {
                $.ajax({
                    url: "{{ route('horarioAula.index') }}",
                    type: "GET",
                    dataType: 'JSON',
                    success: function(result) {
                        var dados = result['dados'];

                        dados.forEach(dado => {
                            var index = 0;

                            var tipoMateria = "";

                            switch (dado['materia'][index]['tipo_materia']) {
                                case 1:
                                    tipoMateria = 'Exatas';
                                    break;
                                case 2:
                                    tipoMateria = 'Humanas';
                                    break;
                                case 3:
                                    tipoMateria = 'Linguagens';
                                    break;
                            }

                            var newRow = $("<tr id='aulaHorario" + dado['id'] + "'>");
                            var cols = "";
                            cols +=
                                '<td><div class="form-check"><input class="form-check-input" name="aulaHorario" value="' +
                                dado["id"] + '"type="radio" id="aulaHorario' + dado["id"] +
                                '"></div></td>';
                            cols += '<td>' + dado["materia"][index]["nome"] + '</td>';
                            cols += '<td>' + tipoMateria + '</td>';
                            cols += '<td>' + dado["dados_user"][index]["name"] + '</td>';
                            cols += '<td>' + convertDate(dado["data"]) + '</td>';
                            cols += '<td>' + dado["hora_inicio"] + '</td>';
                            cols += '<td>' + dado["hora_fim"] + '</td>';

                            newRow.append(cols);

                            $("#tableAulaHorario").append(newRow);

                            index++;
                        });

                    }
                });
            });

            // Listar Todas as Materias.
            $(function() {
                $.ajax({
                    url: "{{ route('materia.index') }}",
                    type: "GET",
                    dataType: 'JSON',
                    success: function(result) {
                        var dados = result["dados"];

                        dados.forEach(dado => {

                            var newRow = $("<option value='" + dado['id'] + "'>" + dado['nome'] +
                                "</option>");

                            $("#addAulaMateria").append(newRow);
                        });

                    }
                });
            });

            // Listar Todos Usuarios.
            $(function() {
                $.ajax({
                    url: "{{ route('registro.index') }}",
                    type: "GET",
                    dataType: 'JSON',
                    success: function(result) {
                        var dados = result["dados"];

                        dados.forEach(dado => {

                            if (dado['status'] == 3) {
                                var newRow = $("<option value='" + dado['id'] + "'>" + dado[
                                        'name'] +
                                    "</option>");

                                $("#addAulaProfessor").append(newRow);
                            }

                        });

                    }
                });
            });


            // Inserir Usuario.
            $(function() {
                $('form[name="formAddAula"]').submit(function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: "{{ route('horarioAula.store') }}",
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(result) {
                            var dados = result["dados"];

                            console.log(dados);

                            if (result['status'] == 'success') {
                                var tipoMateria = "";

                                switch (dados['materia'][0]['tipo_materia']) {
                                    case 1:
                                        tipoMateria = 'Exatas';
                                        break;
                                    case 2:
                                        tipoMateria = 'Humanas';
                                        break;
                                    case 3:
                                        tipoMateria = 'Linguagens';
                                        break;
                                }

                                var newRow = $("<tr id='aulaHorario" + dados['id'] +
                                    "'>");
                                var cols = "";
                                cols +=
                                    '<td><div class="form-check"><input class="form-check-input" name="aulaHorario" value="' +
                                    dados["id"] + '"type="radio" id="aulaHorario' + dados[
                                        "id"] +
                                    '"></div></td>';
                                cols += '<td>' + dados["materia"][0]["nome"] +
                                    '</td>';
                                cols += '<td>' + tipoMateria + '</td>';
                                cols += '<td>' + dados["dados_user"][0]["name"] +
                                    '</td>';
                                cols += '<td>' + convertDate(dados["data"]) + '</td>';
                                cols += '<td>' + dados["hora_inicio"] + '</td>';
                                cols += '<td>' + dados["hora_fim"] + '</td>';

                                newRow.append(cols);

                                $("#tableAulaHorario").append(newRow);
                                $('#modalAddAula').modal('toggle');
                                $('#formAddAula').trigger("reset");

                                swal("Sucesso", "A aula de " + dados["materia"][0]["nome"] +
                                    " do professor " + dados["dados_user"][0]["name"] +
                                    " foi inserido com sucesso!!", "success");
                            } else {
                                swal('Oops!', result["message"], "error");
                            }

                        },
                        error: function(result) {
                            swal('Oops!',
                                'Alguma coisa aconteceu com nossos serviços, tente mais tarde',
                                "error");
                        }

                    });
                });
            })

            // // Listar Usuario Expecifico Para Update.
            // $(function() {
            //     $('#modelEditUser').click(function() {
            //         var idUser = $('input[name="user"]:checked').val();

            //         if (idUser !== undefined) {
            //             $('#modalEditUser').trigger("reset");

            //             $.ajax({
            //                 url: "{{ route('registro.show', '') }}" + "/" + idUser,
            //                 type: "GET",
            //                 dataType: 'json',
            //                 success: function(result) {
            //                     var dados = result["dados"];
            //                     $('#editNameUser').val(dados["name"]);
            //                     $('#editLastNameUser').val(dados["sobre_nome"]);
            //                     $('#editDocumentUser').val(dados["documento"]);
            //                     $('#editBirthDateUser').val(dados["data_nacimento"]);
            //                     $('#editTipoUser').val(dados["status"]);
            //                     $('#modalEditUser').modal('toggle');
            //                 }
            //             });
            //         } else {
            //             swal('Oops!',
            //                 'Selecione um usuario para poder editar',
            //                 "warning");
            //         }
            //     });
            // });

            // // Update do Usuario.
            // $(function() {
            //     $('form[name="formEditUser"]').submit(function(event) {
            //         event.preventDefault();

            //         var idUser = $('input[name="user"]:checked').val();

            //         $.ajax({
            //             url: "{{ route('registro.update', '') }}" + "/" + idUser,
            //             type: "PUT",
            //             data: $(this).serialize(),
            //             dataType: 'json',
            //             success: function(result) {
            //                 var dado = result["dados"];

            //                 if (result['status'] == 'success') {
            //                     var tipo = "";

            //                     switch (dado["status"]) {
            //                         case '1':
            //                             tipo = 'Administrador';
            //                             break;
            //                         case '2':
            //                             tipo = 'Supervisor';
            //                             break;
            //                         case '3':
            //                             tipo = 'Professor';
            //                             break;
            //                         default:
            //                             tipo = 'Aluno';
            //                     }

            //                     var newRow = $("<tr id='user" + dado['id'] + "'>");
            //                     var cols = "";
            //                     cols +=
            //                         '<td><div class="form-check"><input class="form-check-input" name="user" value="' +
            //                         dado["id"] + '"type="radio" id="users' + dado["id"] +
            //                         '"></div></td>';
            //                     cols += '<td>' + dado["name"] + '</td>';
            //                     cols += '<td>' + dado["sobre_nome"] + '</td>';
            //                     cols += '<td>' + dado["documento"] + '</td>';
            //                     cols += '<td>' + dado["data_nacimento"] + '</td>';
            //                     cols += '<td>' + dado["email"] + '</td>';
            //                     cols += '<td>' + tipo + '</td>';

            //                     newRow.append(cols);
            //                     $('#user' + idUser).remove();
            //                     $("#tableUser").append(newRow);
            //                     $('#modalEditUser').modal('toggle');
            //                     $('#formAddUser').trigger("reset");

            //                     swal("Sucesso", "O Usuario " + dado['name'] +
            //                         " foi alterado com sucesso!!", "success");
            //                 } else {
            //                     swal('Oops!', formatMessage(dado), "error");
            //                 }

            //             },
            //             error: function(result) {
            //                 swal('Oops!',
            //                     'Alguma coisa aconteceu com nossos serviços, tente mais tarde',
            //                     "error");
            //             }

            //         });
            //     });

            // });

            // // Delete do Usuario.
            // $(function() {
            //     $('#deleteUser').click(function() {
            //         var token = {
            //             "token": "123456789123456789123456789"
            //         };
            //         var idUser = $('input[name="user"]:checked').val();

            //         if (idUser !== undefined) {
            //             $.ajax({
            //                 url: "{{ route('registro.destroy', '') }}" + "/" + idUser,
            //                 type: "DELETE",
            //                 data: token,
            //                 dataType: 'json',
            //                 success: function(result) {
            //                     if (result['status'] == 'success') {
            //                         $('#user' + idUser).remove();
            //                         swal('Sucesso',
            //                             'O Usuario Selecionado foi Deletado!!',
            //                             "success");
            //                     } else {
            //                         var massage = result['message'];
            //                         swal('Oops!!', massage, "error");
            //                     }
            //                 }
            //             });
            //         } else {
            //             swal('Oops!',
            //                 'Selecione um usuario para poder deletar',
            //                 "warning");
            //         }
            //     });
            // });

            // // Função Formata Resposta de Erro.
            // function formatMessage(dados) {
            //     var message = "Esses dados não estão conforme estabelecido: \n";

            //     if (dados['documento'] !== undefined) {
            //         message += " - Documento deve conter 12 caracteres. \n";
            //     }

            //     if (dados['data_nacimento'] !== undefined) {
            //         message += " - Comfira a data de nascimento. \n";
            //     }

            //     if (dados['email'] !== undefined) {
            //         message += " - O e-mail informado já está em uso. \n";
            //     }

            //     if (dados['password'] !== undefined) {
            //         message += " - A senha deve conter no minimo 8 caracteres. \n";
            //     }

            //     return message;
            // }

        </script>
    @endpush

@endsection
