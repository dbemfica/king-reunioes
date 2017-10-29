@extends('index')
@section('page.title')
    King Reuniões - Salas
@endsection
@section('css.custom')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Salas
            <small>Lista de salas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Salas</li>
        </ol>
    </section>
    <section class="content">
        @if ( session()->has('success') )
            <div class="alert alert-success">
                <ul>
                    <li>{{ session()->get('success') }}</li>
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{ route('rooms.form') }}" class="btn btn-primary" title="Cadastrar Sala"><i class="fa fa-cubes"></i>&nbsp;&nbsp;Cadastrar Sala</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $rooms as $room)
                                <tr>
                                    <td>{{ $room->id }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>
                                        <a href="{{ route('rooms.edit',['id' => $room->id]) }}" class="btn btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                                        &nbsp;&nbsp;
                                        <button type="button" class="btn btn-sm btn-danger btn-remove" title="Remover"  data-toggle="modal" data-target="#modal-remove"><i class="fa fa-trash"></i></button>
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
    <!-- Modal -->
    <div class="modal fade" id="modal-remove">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Remover sala</h4>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deja remover o sala?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Não</button>
                    <form action="" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="modal-remove-id" name="id">
                        <button type="submit" class="btn btn-primary">Sim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            });
        })
    </script>
@endsection