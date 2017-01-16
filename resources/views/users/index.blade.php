@extends('layouts.app')

@section('htmlheader_title')
    Usuários
@stop

@section('contentheader_title')
    Usuários
    <ul class="list-inline">
        <li><a href="{{ route('user.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Adicionar</a></li>
        @if($deleted == 1)
        <li><a href="{{ route('user.index') }}" class="btn  btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i> Ativos</a></li>
        @else
        <li><a href="{{ route('user.deleted', ['deleted' => 1]) }}" class="btn  btn-danger btn-xs"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Excluídos</a></li>
        @endif
    </ul>    
@stop

@section('htmlheader_css')
    <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('scripts_js')
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/js/usersList.js') }}"></script>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Listar Usuários {{ $deleted == 1 ? ' Excluídos'  : ' Ativos' }}</h3>
                    </div>
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="user" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="table_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="order" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Ordernar por nome do usuário">Nome</th>
                                                <th class="sorting" tabindex="0" aria-controls="order" rowspan="1" colspan="1" aria-label="Ordernar pelo e-mail do usuário">E-mail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach ($users as $user)
                                            <tr role="row" class="">
                                                <td>
                                                    {{ $user['name'] }} <br>
                                                    @if ($deleted == 0)
                                                        @if ($user['id'] != Auth::user()->id)            
                                                        <div class="deleteForm">
                                                            {!! Form::open(['route' => ['user.destroy', $user['id']], 'method' => 'delete', 'id'=>'form'.$user['id']]) !!}
                                                            {!! Form::button('<i class="fa fa-times"></i> Excluir', ['type' => 'submit','class' => 'btn btn-danger', 'onclick'=>"deleteConfirm(event, {$user['id']})"]) !!}
                                                            {!! Form::close() !!}
                                                            &nbsp; &nbsp;
                                                        </div>
                                                        @endif
                                                        <a href="{{ route('user.edit',['id' => $user['id']]) }}" class='btn btn-warning'><i class="fa fa-edit"></i> Editar</a>
                                                    @endif
                                                </td>
                                                <td>{{ $user['email'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">Nome</th>
                                                <th rowspan="1" colspan="1">E-mail</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection