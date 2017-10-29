@extends('index')
@section('page.title')
    King Reuniões - Usuários
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Formulário
            <small>Formulário do usuário</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Usuários</li>
        </ol>
    </section>
    <section class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-primary">
                    <form {{ route('users.create') }} method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nome Complete</label>
                                <input type="text" name="name" class="form-control" placeholder="Seu Nome Completo" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="email" class="form-control" placeholder="Seu e-mail" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Senha">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection