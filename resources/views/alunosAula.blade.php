@extends('layouts.app')

@section('content')
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddAlunoAula">
                    <i class="bi bi-patch-plus users"></i>Adicionar Aluno Na Aula
                </button>

                <button class="btn btn-primary" id="modelEditAlunoAula"><i class="bi bi-patch-minus users"></i>Editar
                    Aluno Na Aula</button>

                <button class="btn btn-danger" id="deleteAlunoAula"><i class="bi bi-patch-question users"></i>Deletar
                    Aluno Da Aula</button>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped" id="tableAlunoAula">
                    <thead style="background: #b6d7ff">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome da Materia</th>
                            <th scope="col">Tipo da Materia</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Add User --}}
    <div class="modal fade" id="modalAddAlunoAula" tabindex="-1" role="dialog" aria-labelledby="modalAddAlunoAula"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header imagens-modal">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Adicionar Aluno Na Aula</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body imagens-modal">
                    <form id="formAddAlunoAula" name="formAddAlunoAula">
                        <div class="form-group">
                            <label for="nomeAulaHorario" class="col-form-label text-white">Nome Aula e Horario</label>
                            <select name="hora_id" id="addNomeAulaHorario" class="form-select form-control">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="usuarioAulaHorario" class="col-form-label text-white">Nome Usuario</label>
                            <select name="user_id" id="addUsuarioAulaHorario" class="form-select form-control">
                            </select>
                        </div>

                        <div class="form-group" hidden>
                            <input id="status" name="status" value="1">
                        </div>

                        <div class="form-group" hidden>
                            <input id="AulaHorarioToken" name="token" value="123456789123456789123456789">
                        </div>

                    </form>
                </div>
                <div class="modal-footer imagens-modal">
                    <button type="submit" class="btn btn-success" form="formAddMateria">Cadastrar Materia</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit User --}}
    <div class="modal fade" id="modelEditAlunoAula" tabindex="-1" role="dialog" aria-labelledby="modelEditAlunoAula"
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
                    <form id="formAddAlunoAula" name="formAddAlunoAula">
                        <div class="form-group">
                            <label for="editNomeAulaHorario" class="col-form-label text-white">Nome Aula e Horario</label>
                            <select name="hora_id" id="editNomeAulaHorario" class="form-select form-control">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editUsuarioAulaHorario" class="col-form-label text-white">Nome Usuario</label>
                            <select name="user_id" id="editUsuarioAuloHorario" class="form-select form-control">
                            </select>
                        </div>

                        <div class="form-group" hidden>
                            <input id="status" name="status" value="1">
                        </div>

                        <div class="form-group" hidden>
                            <input id="AulaHorarioToken" name="token" value="123456789123456789123456789">
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
        {{-- <script>
            // Listar Todos Usuarios.
            $(function() {
                $.ajax({
                    url: "{{ route('registro.index') }}",
                    type: "GET",
                    dataType: 'JSON',
                    success: function(result) {
                        var dados = result["dados"];

                        dados.forEach(dado => {
                            var tipo = "";

                            switch (dado["status"]) {
                                case '1':
                                    tipo = 'Administrador';
                                    break;
                                case '2':
                                    tipo = 'Supervisor';
                                    break;
                                case '3':
                                    tipo = 'Professor';
                                    break;
                                default:
                                    tipo = 'Aluno';
                            }

                            var newRow = $("<tr id='user" + dado['id'] + "'>");
                            var cols = "";
                            cols +=
                                '<td><div class="form-check"><input class="form-check-input" name="user" value="' +
                                dado["id"] + '"type="radio" id="users' + dado["id"] +
                                '"></div></td>';
                            cols += '<td>' + dado["name"] + '</td>';
                            cols += '<td>' + dado["sobre_nome"] + '</td>';
                            cols += '<td>' + dado["documento"] + '</td>';
                            cols += '<td>' + dado["data_nacimento"] + '</td>';
                            cols += '<td>' + dado["email"] + '</td>';
                            cols += '<td>' + tipo + '</td>';

                            newRow.append(cols);

                            $("#tableUser").append(newRow);
                        });

                    }
                });
            });

            // Inserir Usuario.
            $(function() {
                $('form[name="formAddUser"]').submit(function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: "{{ route('registro.store') }}",
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(result) {
                            var dado = result["dados"];

                            if (result['status'] == 'success') {
                                var tipo = "";

                                switch (dado["status"]) {
                                    case '1':
                                        tipo = 'Administrador';
                                        break;
                                    case '2':
                                        tipo = 'Supervisor';
                                        break;
                                    case '3':
                                        tipo = 'Professor';
                                        break;
                                    default:
                                        tipo = 'Aluno';
                                }

                                var newRow = $("<tr id='user" + dado['id'] + "'>");
                                var cols = "";
                                cols +=
                                    '<td><div class="form-check"><input class="form-check-input" name="user" value="' +
                                    dado["id"] + '"type="radio" id="users' + dado["id"] +
                                    '"></div></td>';
                                cols += '<td>' + dado["name"] + '</td>';
                                cols += '<td>' + dado["sobre_nome"] + '</td>';
                                cols += '<td>' + dado["documento"] + '</td>';
                                cols += '<td>' + dado["data_nacimento"] + '</td>';
                                cols += '<td>' + dado["email"] + '</td>';
                                cols += '<td>' + tipo + '</td>';

                                newRow.append(cols);
                                $("#tableUser").append(newRow);
                                $('#modalAddUser').modal('toggle');
                                $('#formAddUser').trigger("reset");

                                swal("Sucesso", "O Usuario " + dado['name'] +
                                    " foi inserido com sucesso!!", "success");
                            } else {
                                swal('Oops!', formatMessage(dado), "error");
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

            // Listar Usuario Expecifico Para Update.
            $(function() {
                $('#modelEditUser').click(function() {
                    var idUser = $('input[name="user"]:checked').val();

                    if (idUser !== undefined) {
                        $('#modalEditUser').trigger("reset");

                        $.ajax({
                            url: "{{ route('registro.show', '') }}" + "/" + idUser,
                            type: "GET",
                            dataType: 'json',
                            success: function(result) {
                                var dados = result["dados"];
                                $('#editNameUser').val(dados["name"]);
                                $('#editLastNameUser').val(dados["sobre_nome"]);
                                $('#editDocumentUser').val(dados["documento"]);
                                $('#editBirthDateUser').val(dados["data_nacimento"]);
                                $('#editTipoUser').val(dados["status"]);
                                $('#modalEditUser').modal('toggle');
                            }
                        });
                    } else {
                        swal('Oops!',
                            'Selecione um usuario para poder editar',
                            "warning");
                    }
                });
            });

            // Update do Usuario.
            $(function() {
                $('form[name="formEditUser"]').submit(function(event) {
                    event.preventDefault();

                    var idUser = $('input[name="user"]:checked').val();

                    $.ajax({
                        url: "{{ route('registro.update', '') }}" + "/" + idUser,
                        type: "PUT",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(result) {
                            var dado = result["dados"];

                            if (result['status'] == 'success') {
                                var tipo = "";

                                switch (dado["status"]) {
                                    case '1':
                                        tipo = 'Administrador';
                                        break;
                                    case '2':
                                        tipo = 'Supervisor';
                                        break;
                                    case '3':
                                        tipo = 'Professor';
                                        break;
                                    default:
                                        tipo = 'Aluno';
                                }

                                var newRow = $("<tr id='user" + dado['id'] + "'>");
                                var cols = "";
                                cols +=
                                    '<td><div class="form-check"><input class="form-check-input" name="user" value="' +
                                    dado["id"] + '"type="radio" id="users' + dado["id"] +
                                    '"></div></td>';
                                cols += '<td>' + dado["name"] + '</td>';
                                cols += '<td>' + dado["sobre_nome"] + '</td>';
                                cols += '<td>' + dado["documento"] + '</td>';
                                cols += '<td>' + dado["data_nacimento"] + '</td>';
                                cols += '<td>' + dado["email"] + '</td>';
                                cols += '<td>' + tipo + '</td>';

                                newRow.append(cols);
                                $('#user' + idUser).remove();
                                $("#tableUser").append(newRow);
                                $('#modalEditUser').modal('toggle');
                                $('#formAddUser').trigger("reset");

                                swal("Sucesso", "O Usuario " + dado['name'] +
                                    " foi alterado com sucesso!!", "success");
                            } else {
                                swal('Oops!', formatMessage(dado), "error");
                            }

                        },
                        error: function(result) {
                            swal('Oops!',
                                'Alguma coisa aconteceu com nossos serviços, tente mais tarde',
                                "error");
                        }

                    });
                });

            });

            // Delete do Usuario.
            $(function() {
                $('#deleteUser').click(function() {
                    var token = {
                        "token": "123456789123456789123456789"
                    };
                    var idUser = $('input[name="user"]:checked').val();

                    if (idUser !== undefined) {
                        $.ajax({
                            url: "{{ route('registro.destroy', '') }}" + "/" + idUser,
                            type: "DELETE",
                            data: token,
                            dataType: 'json',
                            success: function(result) {
                                if (result['status'] == 'success') {
                                    $('#user' + idUser).remove();
                                    swal('Sucesso',
                                        'O Usuario Selecionado foi Deletado!!',
                                        "success");
                                } else {
                                    var massage = result['message'];
                                    swal('Oops!!', massage, "error");
                                }
                            }
                        });
                    } else {
                        swal('Oops!',
                            'Selecione um usuario para poder deletar',
                            "warning");
                    }
                });
            });

            // Função Formata Resposta de Erro.
            function formatMessage(dados) {
                var message = "Esses dados não estão conforme estabelecido: \n";

                if (dados['documento'] !== undefined) {
                    message += " - Documento deve conter 12 caracteres. \n";
                }

                if (dados['data_nacimento'] !== undefined) {
                    message += " - Comfira a data de nascimento. \n";
                }

                if (dados['email'] !== undefined) {
                    message += " - O e-mail informado já está em uso. \n";
                }

                if (dados['password'] !== undefined) {
                    message += " - A senha deve conter no minimo 8 caracteres. \n";
                }

                return message;
            }

        </script> --}}
    @endpush

@endsection
