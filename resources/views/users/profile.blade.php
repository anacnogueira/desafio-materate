@extends('layouts.app')

@section('htmlheader_title')
    Atualizar Perfil
@stop

@section('contentheader_title')
    Atualizar Perfil
@stop

@section('htmlheader_css')
 
@stop

@section('scripts_js')

@stop

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">
        {!! Session::get('success') !!}
    </div>
@elseif (Session::has('error'))
	<div class="alert alert-error">
        {!! Session::get('error') !!}
    </div>    
@endif
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img src="{{ asset($user->img_path) }}" class="profile-user-img img-responsive img-circle" >
					<h3 class="profile-username text-center">{{ $user->name }}</h3>					
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="box box-primary">
				<div class="box-body box-profile">	
					{!! Form::model($user, ['class' =>'form-horizontal','route'=>['user.update', 'id' => $user->id],'method'=>'put', 'files' => true]) !!}
					{!! Form::hidden('oldfile', $user->image); !!}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group @if ($errors->has('name')) has-error @endif">
								{!! Form::label('name', 'Nome',['class'=>'col-sm-2 control-label']) !!} 
								<div class="col-sm-10">
									{!! Form::text('name', $user->name, $attributes = ['class' => 'form-control']); !!}
									@if ($errors->has('name')) <span class="help-block">Este campo é obrigatório</span> @endif
								</div>
							</div>
							
							<div class="form-group @if ($errors->has('email')) has-error @endif">
								{!! Form::label('email', 'E-mail',['class'=>'col-sm-2 control-label']) !!} 
								<div class="col-sm-10">
									{!! Form::text('email', $user->email, $attributes = ['class' => 'form-control']); !!}
									@if ($errors->has('email')) <span class="help-block">Este campo é obrigatório</span> @endif
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('file', 'Foto',['class'=>'col-sm-2 control-label']) !!} 
								<div class="col-sm-10">
									{!! Form::file('file', null, $attributes = ['class' => 'form-control']); !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('password', 'Senha',['class'=>'col-sm-2 control-label']) !!} 
								<div class="col-sm-10">
									{!! Form::password('password', ['class' => 'form-control','readonly'=>'readonly']); !!}
								</div>							
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									{!! Form::button('<i class="fa fa-check"></i> Salvar Alterações', ['type' => 'submit','class' => 'btn btn-success']) !!}
								</div>
							</div>
						</div>
					</div>	
					{!! Form::close() !!}
					</div>
				</div>	
			</div>
		</div>
	</div>
</section>
@endsection