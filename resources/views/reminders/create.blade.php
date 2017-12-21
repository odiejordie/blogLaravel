@extends('layout.layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-6 offset-sm-3">
				<h1>Reset Password</h1>
				{{ Form::open(array('route' => 'reminders.store')) }}
					<div class="form-group">
						{{ Form::label('email', 'Email', array('class' => 'form-label')) }}
						{{ Form::text('email', null, array('class' => 'form-control')) }}
						<small class="text-danger">{{ $errors->first('email') }}</small>
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