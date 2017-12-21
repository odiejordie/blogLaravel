@extends('layout.layout')

@section('navbar')

	@include('user.navbar')	

@endsection

@section('customstyle')
<style>
.parallax {
    /* The image used */
    background-image: url("{{asset($user->foto)}}");

    /* Set a specific height */
    min-height: 500px; 

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: calc(100% + 50px);
}

.file {
  	visibility: hidden;
  	position: absolute;
}
</style>
@endsection

@section('content')
<div class="parallax" id="top-image">
	
</div>
<div class="container" style="margin-top: 10px;">
	<div class="row">
		<div class="col-sm-3" style="bottom:100px">
			<img src="{{ asset($user->foto) }}" class="rounded mx-auto 2-block img-fluid img-thumbnail" alt="Responsive image">
			<h3>{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</h3>
			{{ Sentinel::getUser()->email }}
		</div>
		<div class="col-sm-9">
			<div class="card" style="margin-bottom: 10px">
			  	<div class="card-body">
			  		{{ Form::open(array('route' => array('user.update', $user->user->id), 'method' => 'PUT')) }}
			  			<h2><small>Profil User</small></h2>
			  			<hr>
			  			<div class="form-group">
			  				{{ Form::label('first_name', 'First name', array('class' => 'form-label')) }}
			  				{{ Form::text('first_name', $user->user->first_name, array('class' => 'form-control', 'placeholder' => 'First name')) }}
			  			</div>
			  			<div class="form-group">
			  				{{ Form::label('last_name', 'last name', array('class' => 'form-label')) }}
			  				{{ Form::text('last_name', $user->user->last_name, array('class' => 'form-control', 'placeholder' => 'Last name')) }}
			  			</div>
			  			<div class="form-group">
			  				{{ Form::label('email', 'Email', array('class' => 'form-label')) }}
			  				{{ Form::text('email', $user->user->email, array('class' => 'form-control', 'placeholder' => 'Email')) }}
			  			</div>
			  			{{ Form::submit('Update', array('class' => 'btn btn-secondary col-sm-2 float-sm-right', 'style' => 'margin-top:10px')) }}
		  			{{ Form::close() }}
		  			@if(count($user->user_id) < 1)
			  			{{ Form::open(array('route' => 'bio.store', 'files' => 'true')) }}
				  			<hr style="margin-top:80px">
				  			<h2><small>Biodata</small></h2>
				  			<hr>
				  			{{ Form::hidden('user_id', $user->user->id) }}
				  			<div class="form-group">
				  				{{ Form::label('ttl', 'TTL', array('class' => 'form-label')) }}
				  				{{ Form::text('ttl', null, array('class' => 'form-control', 'placeholder' => 'TTL')) }}
				  			</div>
				  			<div class="form-group">
				  				{{ Form::label('jenkel', 'Jenis kelamin', array('class' => 'form-label')) }}
				  				{{ Form::text('jenkel', null, array('class' => 'form-control', 'placeholder' => 'Jenis kelamin')) }}
				  			</div>
				  			<div class="form-group">
				  				{{ Form::label('nohp', 'No. Handphone', array('class' => 'form-label')) }}
				  				{{ Form::text('nohp', null, array('class' => 'form-control', 'placeholder' => 'Nomor handphone')) }}
				  			</div>
				  			<div class="form-group">
				  				{{ Form::label('alamat', 'Alamat', array('class' => 'form-label')) }}
				  				{{ Form::textarea('alamat', null, array('class' => 'form-control', 'placeholder' => 'Alamat')) }}
				  			</div>
				  			<div class="form-group">
				  				{{ Form::label('hobi', 'Hobi', array('class' => 'form-label')) }}
				  				{{ Form::textarea('hobi', null, array('class' => 'form-control', 'placeholder' => 'Hobi')) }}
				  			</div>
				  			<div class="form-group">
				  				{{ Form::label('foto', 'Foto', array('class' => 'form-label')) }}
							    {{ Form::file('foto', array('class' => 'file')) }}
							    <div class="input-group col-xs-12">
								    <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
								    <span class="input-group-btn">
								        <button class="browse btn btn-secondary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
								    </span>
							    </div>
							</div>
				    		{{ Form::submit('Tambah Bio', array('class' => 'btn btn-secondary col-sm-2 float-sm-right', 'style' => 'margin-top:10px')) }}
				  		{{ Form::close() }}
		  			@else
			  			{{ Form::open(array('route' => array('bio.update', $user->user->id), 'method' => 'PUT', 'files' => 'true')) }}
				  			<hr style="margin-top:80px">
				  			<h2><small>Biodata</small></h2>
				  			<hr>
				  			<div class="form-group">
				  				{{ Form::label('ttl', 'TTL', array('class' => 'form-label')) }}
				  				{{ Form::text('ttl', $user->ttl, array('class' => 'form-control', 'placeholder' => 'TTL')) }}
				  			</div>
				  			<div class="form-group">
				  				{{ Form::label('jenkel', 'Jenis kelamin', array('class' => 'form-label')) }}
				  				{{ Form::text('jenkel', $user->jenkel, array('class' => 'form-control', 'placeholder' => 'Jenis kelamin')) }}
				  			</div>
				  			<div class="form-group">
				  				{{ Form::label('nohp', 'No. Handphone', array('class' => 'form-label')) }}
				  				{{ Form::text('nohp', $user->nohp, array('class' => 'form-control', 'placeholder' => 'Nomor handphone')) }}
				  			</div>
				  			<div class="form-group">
				  				{{ Form::label('alamat', 'Alamat', array('class' => 'form-label')) }}
				  				{{ Form::textarea('alamat', $user->alamat, array('class' => 'form-control', 'placeholder' => 'Alamat')) }}
				  			</div>
				  			<div class="form-group">
				  				{{ Form::label('hobi', 'Hobi', array('class' => 'form-label')) }}
				  				{{ Form::textarea('hobi', $user->hobi, array('class' => 'form-control', 'placeholder' => 'Hobi')) }}
				  			</div>
				  			<div class="form-group">
				  				{{ Form::label('foto', 'Foto', array('class' => 'form-label')) }}
							    {{ Form::file('foto', array('class' => 'file')) }}
							    <div class="input-group col-xs-12">
								    <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
								    <span class="input-group-btn">
								        <button class="browse btn btn-secondary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
								    </span>
							    </div>
							</div>
				    		{{ Form::submit('Update', array('class' => 'btn btn-secondary col-sm-2 float-sm-right', 'style' => 'margin-top:10px')) }}
				  		{{ Form::close() }}
		  			@endif
			  	</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	$(document).ready(function() {
	    var movementStrength = 25;
	    var height = movementStrength / $(window).height();
	    var width = movementStrength / $(window).width();
	    $("#top-image").mousemove(function(e){
	        var pageX = e.pageX - ($(window).width() / 2);
	        var pageY = e.pageY - ($(window).height() / 2);
	        var newvalueX = width * pageX * -1 - 25;
	        var newvalueY = height * pageY * -1 - 50;
	        $('#top-image').css("background-position", newvalueX+"px     "+newvalueY+"px");
	    });
	});

	$(document).on('click', '.browse', function(){
	  var file = $(this).parent().parent().parent().find('.file');
	  file.trigger('click');
	});
	$(document).on('change', '.file', function(){
	  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
	});
</script>
@endsection