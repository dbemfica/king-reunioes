@extends('index')
@section('page.title')
    King Reuniões - Reuniões
@endsection
@section('css.custom')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Formulário
            <small>Formulário da reunião</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reuniões</li>
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
                    <form action="{{ route('meetings.update') }}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $meeting->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Selecione a Sala</label>
                                        <select name="room_id" class="form-control select2">
                                            @foreach($rooms as $room)
                                                @if( $room->id == $meeting->room_id )
                                                    <option selected value="{{ $room->id }}">{{ $room->name }}</option>
                                                @else
                                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Data</label>
                                        <input type="text" name="date" class="form-control datepicker" placeholder="Data" value="{{ Carbon\Carbon::parse($meeting->date_time)->format('d/m/Y') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Hora</label>
                                        <select name="time" class="form-control select2">
                                            @for ($i = 0; $i < 24; $i++)
                                                @if( $i == (int)Carbon\Carbon::parse($meeting->date_time)->format('H') )
                                                    <option selected value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}:00:00">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}:00</option>
                                                @else
                                                    <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}:00:00">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}:00</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Nome da Reunião</label>
                                        <input type="text" name="name" class="form-control" placeholder="Nome da Reunião" value="{{ $meeting->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Descrição</label>
                                        <textarea name="description" class="form-control">{{ $meeting->description }}</textarea>
                                    </div>
                                </div>
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
@section('js.custom')
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy'
            })
        })
    </script>
@endsection