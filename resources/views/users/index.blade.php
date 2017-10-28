@extends('index')
@section('page.title')
    King Reuniões - Usuários
@endsection
@section('css.custom')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Usuários
            <small>Lista de usuários</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Usuários</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-primary pull-left" title="Cadastrar Usuário"><i class="fa fa-users"></i>&nbsp;&nbsp;Cadastrar Usuário</button>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></button>
                                        &nbsp;&nbsp;
                                        <button class="btn btn-sm btn-danger" title="Remover"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js.custom')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('.data-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endsection