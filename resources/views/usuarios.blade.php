@extends('layouts.app')

@section('content')
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddUser">
                    <i class="bi bi-person-plus-fill users"></i>Adicionar Usuario
                </button>

                <button class="btn btn-primary" id="modelEditUser"><i class="bi bi-person-lines-fill users"></i>Editar
                    Usuario</button>

                <button class="btn btn-danger" id="deleteUser"><i class="bi bi-person-x-fill users"></i>Deletar
                    Usuario</button>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped" id="tableUser">
                    <thead style="background: #b6d7ff">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Sobre Nome</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Data de Nacimento</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Tipo Usuario</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Add User --}}
    <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="modalAddUser" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header imagens-modal">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Adicionar Usuario</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body imagens-modal">
                    <form id="formAddUser" name="formAddUser">
                        <div class="form-group">
                            <label for="nameUser" class="col-form-label text-white">Nome:</label>
                            <input type="text" class="form-control" id="nameUser" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="lastNameUser" class="col-form-label text-white">Sobre Nome:</label>
                            <input type="text" class="form-control" id="lastNameUser" name="sobre_nome">
                        </div>

                        <div class="form-group">
                            <label for="documentUser" class="col-form-label text-white">Documento:</label>
                            <input type="text" class="form-control" id="documentUser" name="documento" required min="12"
                                max="12">
                        </div>

                        <div class="form-group">
                            <label for="birthDateUser" class="col-form-label text-white">Data Nacimento</label>
                            <input type="date" class="form-control" id="birthDateUser" name="data_nacimento" required>
                        </div>

                        <div class="form-group">
                            <label for="emailUser" class="col-form-label text-white">Email:</label>
                            <input type="email" class="form-control" id="emailUser" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="passwod" class="col-form-label text-white">Senha:</label>
                            <input type="password" class="form-control" id="passwodUser" name="password" required min="8">
                        </div>

                        <div class="form-group" hidden>
                            <input id="userToken" name="token" value="123456789123456789123456789">
                        </div>

                        <div class="form-group">
                            <label for="tipoUser" class="col-form-label text-white">Tipo do Usuario:</label>
                            <select name="status" class="form-select form-control">
                                <option selected value="4">Aluno</option>
                                <option value="3">Professor</option>
                                <option value="2">Supervisor </option>
                                <option value="1">Administrator </option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer imagens-modal">
                    <button type="submit" class="btn btn-success" form="formAddUser">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit User --}}
    <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalEditUser"
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
                    <form id="formEditUser" name="formEditUser">
                        @csrf
                        <div class="form-group">
                            <label for="nameUser" class="col-form-label text-white">Nome:</label>
                            <input type="text" class="form-control" id="editNameUser" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="lastNameUser" class="col-form-label text-white">Sobre Nome:</label>
                            <input type="text" class="form-control" id="editLastNameUser" name="sobre_nome">
                        </div>

                        <div class="form-group">
                            <label for="documentUser" class="col-form-label text-white">Documento:</label>
                            <input type="text" class="form-control" id="editDocumentUser" name="documento" required>
                        </div>

                        <div class="form-group">
                            <label for="birthDateUser" class="col-form-label text-white">Data Nascimento:</label>
                            <input type="date" class="form-control" id="editBirthDateUser" name="data_nacimento" required>
                        </div>

                        <div class="form-group" hidden>
                            <input id="editUserToken" name="token" value="123456789123456789123456789">
                        </div>

                        <div class="form-group">
                            <label for="tipoUser" class="col-form-label text-white">Tipo do Usuario:</label>
                            <select name="status" id="editTipoUser" class="form-select form-control">
                                <option value="4">Aluno</option>
                                <option value="3">Professor</option>
                                <option value="2">Supervisor </option>
                                <option value="1">Administrator </option>
                            </select>
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

        </script>
    @endpush

@endsection
