@extends('layouts.app')

@section('content')
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddMateria">
                    <i class="bi bi-file-earmark-plus users"></i>Adicionar Materia
                </button>

                <button class="btn btn-primary" id="modelEditMateria"><i class="bi bi-file-earmark-minus users"></i>Editar
                    Materia</button>

                <button class="btn btn-danger" id="deleteMateria"><i class="bi bi-file-earmark-x users"></i>Deletar
                    Materia</button>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped" id="tableMateria">
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
    <div class="modal fade" id="modalAddMateria" tabindex="-1" role="dialog" aria-labelledby="modalAddMateria"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header imagens-modal">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Adicionar Materia</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body imagens-modal">
                    <form id="formAddMateria" name="formAddMateria">
                        <div class="form-group">
                            <label for="nomeMateria" class="col-form-label text-white">Nome:</label>
                            <input type="text" class="form-control" id="nomeMateria" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="tipoMateria" class="col-form-label text-white">Tipo da Materia:</label>
                            <select name="tipo_materia" class="form-select form-control" required>
                                <option value="1">Exatas</option>
                                <option value="2">Humanaa</option>
                                <option value="3">Linguagens</option>
                            </select>
                        </div>

                        <div class="form-group" hidden>
                            <input id="materiaToken" name="token" value="123456789123456789123456789">
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
    <div class="modal fade" id="modalEditMateria" tabindex="-1" role="dialog" aria-labelledby="modalEditMateria"
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
                    <form id="formEditMateria" name="formEditMateria">
                        <div class="form-group">
                            <label for="nomeMateria" class="col-form-label text-white">Nome:</label>
                            <input type="text" class="form-control" id="editNomeMateria" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="tipoMateria" class="col-form-label text-white">Tipo da Materia:</label>
                            <select name="tipo_materia" id="editTipoMateria" class="form-select form-control">
                                <option value="1">Exatas</option>
                                <option value="2">Humanaa</option>
                                <option value="3">Linguagens</option>
                            </select>
                        </div>

                        <div class="form-group" hidden>
                            <input id="editmateriaToken" name="token" value="123456789123456789123456789">
                        </div>
                    </form>
                </div>
                <div class="modal-footer imagens-modal">
                    <button type="submit" class="btn btn-success" form="formEditMateria">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Listar Todas as Materias.
            $(function() {
                $.ajax({
                    url: "{{ route('materia.index') }}",
                    type: "GET",
                    dataType: 'JSON',
                    success: function(result) {
                        var dados = result["dados"];

                        dados.forEach(dado => {
                            var tipo = "";

                            switch (dado["tipo_materia"]) {
                                case 1:
                                    tipo = 'Exatas';
                                    break;
                                case 2:
                                    tipo = 'Humanas';
                                    break;
                                case 3:
                                    tipo = 'Linguagens ';
                                    break;
                            }

                            var newRow = $("<tr id='materias" + dado['id'] + "'>");
                            var cols = "";
                            cols +=
                                '<td><div class="form-check"><input class="form-check-input" name="materia" value="' +
                                dado["id"] + '"type="radio" id="materia' + dado["id"] +
                                '"></div></td>';
                            cols += '<td>' + dado["nome"] + '</td>';
                            cols += '<td>' + tipo + '</td>';

                            newRow.append(cols);

                            $("#tableMateria").append(newRow);
                        });

                    }
                });
            });

            // Inserir Materia.
            $(function() {
                $('form[name="formAddMateria"]').submit(function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: "{{ route('materia.store') }}",
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(result) {
                            var dado = result["dados"];

                            if (result['status'] == 'success') {
                                var tipo = "";

                                switch (dado["tipo_materia"]) {
                                    case '1':
                                        tipo = 'Exatas';
                                        break;
                                    case '2':
                                        tipo = 'Humanas';
                                        break;
                                    case '3':
                                        tipo = 'Linguagens ';
                                        break;
                                }

                                var newRow = $("<tr id='materias" + dado['id'] + "'>");
                                var cols = "";
                                cols +=
                                    '<td><div class="form-check"><input class="form-check-input" name="materia" value="' +
                                    dado["id"] + '"type="radio" id="materia' + dado["id"] +
                                    '"></div></td>';
                                cols += '<td>' + dado["nome"] + '</td>';
                                cols += '<td>' + tipo + '</td>';

                                newRow.append(cols);

                                $("#tableMateria").append(newRow);
                                $('#modalAddMateria').modal('toggle');
                                $('#formAddMateria').trigger("reset");

                                swal("Sucesso", "A Materia " + dado['nome'] +
                                    " foi inserido com sucesso!!", "success");
                            } else {
                                swal('Oops!',
                                    "Alguma coisa não está certa, verifique o formulario e tente novamente",
                                    "error");
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

            // Listar Materia Expecifica Para Update.
            $(function() {
                $('#modelEditMateria').click(function() {
                    var idMateria = $('input[name="materia"]:checked').val();

                    if (idMateria !== undefined) {
                        $('#modalEditMateria').trigger("reset");

                        $.ajax({
                            url: "{{ route('materia.show', '') }}" + "/" + idMateria,
                            type: "GET",
                            dataType: 'json',
                            success: function(result) {
                                var dados = result["dados"];
                                $('#editNomeMateria').val(dados["nome"]);
                                $('#editTipoMateria').val(dados["tipo_materia"]);
                                $('#modalEditMateria').modal('toggle');
                            },
                            error: function(result) {
                                swal('Oops!',
                                    'Alguma coisa aconteceu com nossos serviços, tente mais tarde',
                                    "error");
                            }
                        });
                    } else {
                        swal('Oops!',
                            'Selecione uma Materia para poder editar',
                            "warning");
                    }
                });
            });

            // Update do Usuario.
            $(function() {
                $('form[name="formEditMateria"]').submit(function(event) {
                    event.preventDefault();

                    var idMateria = $('input[name="materia"]:checked').val();

                    $.ajax({
                        url: "{{ route('materia.update', '') }}" + "/" + idMateria,
                        type: "PUT",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(result) {
                            var dado = result["dados"];

                            if (result['status'] == 'success') {
                                var tipo = "";

                                switch (dado["tipo_materia"]) {
                                    case '1':
                                        tipo = 'Exatas';
                                        break;
                                    case '2':
                                        tipo = 'Humanas';
                                        break;
                                    case '3':
                                        tipo = 'Linguagens ';
                                        break;
                                }

                                var newRow = $("<tr id='materias" + dado['id'] + "'>");
                                var cols = "";
                                cols +=
                                    '<td><div class="form-check"><input class="form-check-input" name="materia" value="' +
                                    dado["id"] + '"type="radio" id="materia' + dado["id"] +
                                    '"></div></td>';
                                cols += '<td>' + dado["nome"] + '</td>';
                                cols += '<td>' + tipo + '</td>';

                                newRow.append(cols);

                                $("#tableMateria").append(newRow);

                                $('#materias' + idMateria).remove();
                                $("#tableMateria").append(newRow);
                                $('#modalEditMateria').modal('toggle');
                                $('#formEditMateria').trigger("reset");

                                swal("Sucesso", "A materia foi alterado com sucesso!!", "success");
                            } else {
                                swal('Oops!',
                                    "Não foi possivel alterar a mateira, verifique o formulario e tente novamente!!",
                                    "error");
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
                $('#deleteMateria').click(function() {
                    var token = {
                        "token": "123456789123456789123456789"
                    };
                    var idMateria = $('input[name="materia"]:checked').val();

                    if (idMateria !== undefined) {
                        $.ajax({
                            url: "{{ route('materia.destroy', '') }}" + "/" + idMateria,
                            type: "DELETE",
                            data: token,
                            dataType: 'json',
                            success: function(result) {
                                if (result['status'] == 'success') {
                                    $('#materias' + idMateria).remove();
                                    swal('Sucesso',
                                        'A Materia Selecionado foi Deletada!!',
                                        "success");
                                } else {
                                    var massage = result['message'];
                                    swal('Oops!!', massage, "error");
                                }
                            },
                            error: function(result) {
                                swal('Oops!',
                                    'Alguma coisa aconteceu com nossos serviços, tente mais tarde',
                                    "error");
                            }
                        });
                    } else {
                        swal('Oops!',
                            'Selecione uma materia para poder deletar',
                            "warning");
                    }
                });
            });

        </script>

    @endpush

@endsection
