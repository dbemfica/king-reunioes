@extends('index')
@section('page.title')
    King Reuniões - Salas
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Formulário
            <small>Formulário da sala</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Salas</li>
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
                    <form action="{{ route('rooms.update') }}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $room->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nome da Sala</label>
                                <input type="text" name="name" class="form-control" placeholder="Nome da Sala" value="{{ $room->name }}">
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea name="description" class="form-control">{{ $room->description }}</textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection