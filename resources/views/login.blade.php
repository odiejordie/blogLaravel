<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	@include('res.head')
	<style>
		.fullscreen-bg {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            overflow: hidden;
            z-index: -1;
            
        }

        .fullscreen-bg__video {
            position: absolute;
            top: 50%;
            left: 50%;
            width: auto;
            height: auto;
            min-width: 100%;
            min-height: 100%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        @media (max-width: 767px) {
            .fullscreen-bg {
                background: url({{ asset('img/1.jpg') }}) center center / cover no-repeat;
            }

            .fullscreen-bg__video {
                display: none;
            }
        }

        .putih {
        	color:white;
        }
	</style>
</head>
<body>
	<div class="fullscreen-bg">
	    <video class="fullscreen-bg__video" id="top-image" loop autoplay poster="{{ asset('img/1.jpg') }}"> 
	        <source src="{{ asset('vid/footageweb5.mp4') }}" type="video/mp4" />
	    </video>
	</div>

	<nav class="navbar navbar-expand-lg navbar-light fixed-bottom" style="background-color: rgba(0, 0, 0, 0)">		
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>
	  	<div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav ml-auto">
		      	<li class="nav-item dropdown">
		        	<a href="#" class="nav-link putih">
						{{ link_to(route('reminders.create'), 'Lupa Password Eaa!! ?', array('style' => 'color:white')) }}
		        	</a>
		      	</li>
		    </ul>
	  	</div>
	</nav>	
	
	<div class="container-fluid" style="margin-top:14%; background-color:rgba(255, 255, 255, 0.4); padding-top:20px; padding-bottom: 20px">

		<div class="row align-items-center">
			<div class="col-sm-9 align-item-center">
				<h1 class="display-4 putih">#Eaa!!Login</h1>
				<h6 class="putih">Eaa!! adalah sosial media yang kurang penting :3</h6>
			</div>
			<div class="col-sm-3">
				{{ Form::open(array('route' => 'login.store')) }}
					<div class="form-group">
						{{ Form::text('email', null, array('class' => 'form-control form-control-lg border-0', 'placeholder' => 'Email')) }}
						<small class="form-text text-danger">{{ $errors->first('email') }}</small>
						<div class="clear"></div>
					</div>
					<div class="form-group">
						{{ Form::password('password', array('class' => 'form-control form-control-lg border-0', 'placeholder' => 'Password')) }}
						<small class="form-text text-danger">{{ $errors->first('password') }}</small>
						<div class="clear"></div>		
					</div>
					<div class="form-group">
						{{ Form::submit('Eaa!!', array('class' => 'btn btn-secondary btn-block btn-lg')) }}
						{{-- {{ link_to(route('user.index'),'Eaa!!', array('class' => 'btn btn-secondary btn-block btn-lg')) }} --}}
					</div>
					<small>
						{{ Form::label('register', 'belum mempunyai akun Eaa!! ?', array('class' => 'form-label putih')) }}
						<a href="#" onclick="bukamodal()">Daftar disini.</a>
					</small>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	@include('res.foot')
	<script type="text/javascript">
		function bukamodal(){
			$('#modaldaftar').modal('show');
		}
	</script>
	
	<div class="modal fade" id="modaldaftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Daftar Eaa!!</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        </button>
			    </div>
				    <div class="modal-body">
				        {{ Form::open(array('route' => 'signup.store')) }}
				        	<div class="form-group">
				        		{{ Form::label('first_name', 'Nama depan', array('class' => 'form-label')) }}
				        		{{ Form::text('first_name', null, array('class' => 'form-control', 'placeholder' => 'Nama depan')) }}
				        		<small class="form-text text-danger">{{ $errors->first('first_name') }}</small>
				        		<div class="clear"></div>
				        	</div>
				        	<div class="form-group">
				        		{{ Form::label('last_name', 'Nama belakang', array('class' => 'form-label')) }}
				        		{{ Form::text('last_name', null, array('class' => 'form-control', 'placeholder' => 'Nama belakang')) }}
				        		<small class="form-text text-danger">{{ $errors->first('last_name') }}</small>
				        		<div class="clear"></div>
				        	</div>
				        	<div class="form-group">
				        		{{ Form::label('email', 'Email', array('class' => 'form-label')) }}
				        		{{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email anda')) }}
				        		<small class="form-text text-danger">{{ $errors->first('email') }}</small>
				        		<div class="clear"></div>
				        	</div>
				        	<div class="form-group">
				        		{{ Form::label('password', 'Password', array('class' => 'form-label')) }}
				        		{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password anda')) }}
				        		<small class="form-text text-danger">{{ $errors->first('password') }}</small>
				        		<div class="clear"></div>
				        	</div>
				        	<div class="form-group">
				        		{{ Form::label('password_confirmation', 'Konfirmasi password', array('class' => 'form-label')) }}
				        		{{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Password anda')) }}
				        	</div>
				        	<div class="form-group">
				        		{{ Form::submit('Eaa!!', array('class' => 'btn btn-secondary btn-block')) }}
				        	</div>
				        {{ Form::close() }}
				    </div>
			    {{-- <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			    </div> --}}
		    </div>
	  	</div>
	</div>
</body>
</html>