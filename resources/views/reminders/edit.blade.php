@extends('layout.layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-6 offset-sm-3">
				{{ Form::open(array('route' => array('reminders.update', $id, $code))) }}
					<div class="form-group">
						{{ Form::label('password', 'Password baru', array('class' => 'form-label')) }}
						{{ Form::password('password', array('class' => 'form-control')) }}
						<small class="text-danger">{{ $errors->first('email') }}</small>
						<div class="clear"></div>
					</div>
					<div class="form-group">
						{{ Form::label('password_confirmation', 'Konfirmasi password', array('class' => 'form-label')) }}
						{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
						<div class="clear"></div>
					</div>
					<div class="form-group">
						{{ Form::submit('Eaa!!', array('class' => 'btn btn-secondary btn-block')) }}
					</div>
				{{ Form::close() }}	
			</div>
		</div>
	</div>
	
@endsection