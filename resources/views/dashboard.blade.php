@extends('index')
@section('page.title')
    King Reuniões - Dashboard
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Usuários</span>
                        <span class="info-box-number">{{ $usersCount }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-cubes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Salas</span>
                        <span class="info-box-number">{{ $roomsCount }}</span>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Reuniões</span>
                        <span class="info-box-number">{{ $meetingsCount }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h4>A agenda para os proximos 2 dias</h4>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                            <tr>
                                <th>Sala</th>
                                <th>Data e Hora</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if( $schendules )
                                @foreach( $schendules as $schendule)
                                    <tr>
                                        <td>{{ $schendule['room_name'] }}</td>
                                        <td>{{ Carbon\Carbon::parse($schendule['date'])->format('d/m/Y H:i:s') }}</td>
                                        @if($schendule['available'])
                                            <td><span class="label label-success">Disponível</span></td>
                                            <td><a href="{{route('meetings.form',['room' => $schendule['room_id'], 'date' => $schendule['date']])}}" class="btn btn-sm btn-primary" title="Agendas para {{ Carbon\Carbon::parse($schendule['date'])->format('d/m/Y H:i:s') }}"><i class="fa fa-calendar-check-o"></i></a></td>
                                        @else
                                            <td><span class="label label-danger">Indisponível</span></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
@endsection