@extends('layouts.app')

@section('content')

    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sobre_nome"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Sobre Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="sobre_nome" type="text"
                                        class="form-control @error('sobre_nome') is-invalid @enderror" name="sobre_nome"
                                        value="{{ old('sobre_nome') }}" required autocomplete="sobre_nome" autofocus>

                                    @error('sobre_nome')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="data_nacimento"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Data Nacimento') }}</label>

                                <div class="col-md-6">
                                    <input id="data_nacimento" type="date"
                                        class="form-control @error('data_nacimento') is-invalid @enderror"
                                        name="data_nacimento" value="{{ old('data_nacimento') }}" required
                                        autocomplete="data_nacimento" autofocus>

                                    @error('data_nacimento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="documento"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Documento') }}</label>

                                <div class="col-md-6">
                                    <input id="documento" type="text"
                                        class="form-control @error('documento') is-invalid @enderror" name="documento"
                                        value="{{ old('documento') }}" required autocomplete="documento" autofocus>

                                    @error('documento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tipo Usuario') }}</label>

                                <div class="col-md-6">
                                    <select name="status" class="form-select form-control" value="{{ old('status') }}">
                                        <option selected value="4">Aluno</option>
                                        <option value="3">Professor</option>
                                        <option value="2">Supervisor </option>
                                        <option value="1">Administrator </option>
                                    </select>

                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
