@extends('layouts.app')

@section('htmlheader_title')
    Usuários
@stop

@section('contentheader_title')
   Usuários
@stop

@section('contentheader_breadcrumb')
    <li><a href="{{ route('user.index') }}"><i class="fa fa-dashboard"></i> Usuários</a></li>
    <li class="active">Editar</li>
@stop


@section('contentheader_breadcrumb')
    <li><a href="{{ route('user.index') }}"><i class="fa fa-dashboard"></i> Sistema &raquo; Usuários</a></li>
    <li class="active">Adicionar</li>
@stop

@section('content')
<section class='content'>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                {!! Form::model($user, ['route'=>['user.update', 'id' => $user->id],'method'=>'put', 'files' => true]) !!}
                @include('users.form')                            
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <ul>
                            <li><a href="{{ route('user.index') }}" class="btn btn-warning"><i class="fa fa-list-alt"></i> Listar</a></li> 
                        </ul>
                    </div>
                </div>
            </div>                
        </div>
    </div>      
</section>
@endsection