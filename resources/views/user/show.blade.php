@extends('layout.layout')

@section('navbar')

	@include('user.navbar')	

@endsection

@section('customstyle')
<style>

.bg-body{
    box-shadow: 0px 0.5px 10px;
}
.parallax {
    /* The image used */
    @if($foto == null)
    background-image: url("{{asset('img/1.jpg')}}");
    @else
    background-image: url("{{asset($foto->foto)}}");
    @endif
    /* Set a specific height */
    min-height: 500px; 

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: calc(100% + 50px);
}
</style>
@endsection

@section('content')
<div class="parallax" id="top-image">
	
</div>
<div class="container-fluid bg-body">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-4">
				@if($foto == null)
				<div class="col-sm-12 text-center" style="bottom:100px;">
					<img src="{{ asset('img/1.jpg') }}" class="rounded mx-auto 2-block img-fluid img-thumbnail" alt="Responsive image">
					<h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
					{{ $user->email }}<br>	
				</div>
				@else
				<div class="col-sm-12 text-center" style="bottom:100px;">
					<img src="{{ asset($foto->foto) }}" class="rounded mx-auto 2-block img-fluid img-thumbnail" alt="Responsive image">
					<h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
					{{ $user->email }}<br>
					<small>
						{{ $foto->jenkel }} |
						Tlp : {{ $foto->nohp }} |
						Ttl : {{ $foto->ttl }} |
						Hobi : {{ $foto->hobi }} |
					</small>
				</div>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card" style="margin-top: 10px; margin-bottom: 10px">
				  	<div class="card-body">
				  		<?php $i = 0;?>
						{{-- BERSASARKAN USER --}}
						@if($foto == null)
							@foreach($postingnonfoto as $row)
								@if(count($row->posting) < 1)
								<div class="media">
									<div class="media-body">
									    Anda belum memposting sesuatu..
									</div>
								</div>
								@else
								{{-- @foreach($row->posts as $post) --}}
							  		<div class="media">
										<img class="mr-3 rounded" src="{{ asset('img/1.jpg') }}" alt="Foto 64x64" style="max-width: 64px; max-height: 64px">
										<div class="media-body">
										    <h5 class="mt-0">{{ $row->first_name }} {{ $row->last_name }}</h5>
										    <p>
										    	{{ $row->posting }}
											</p>
											<div class="float-sm-right">
												{{ Form::open(array('route' => array('user.destroy', $row->id), 'method' => 'delete')) }}
												<a href="#" class="btn btn-secondary btn-sm">Edit</a>
												{{ Form::submit('Hapus', array('class' => 'btn btn-secondary btn-sm')) }}
												{{ Form::close() }}
											</div>
											<div id="exampleAccordion" data-children=".item">
											  	<div class="item">
											    	<small>{{ Sentinel::getUser()->created_at }}</small>
											    	<a data-toggle="collapse" data-parent="#exampleAccordion" href="#exampleAccordion{{$i}}" aria-expanded="false" aria-controls="exampleAccordion{{$i}}" class="btn btn-secondary btn-sm float-right" style="margin-bottom: 5px; margin-right: 5px">
											    		<div id="banyak_komentar{{$i}}">Komentar</div>
											    	</a>
											    	<div id="exampleAccordion{{$i}}" class="collapse" role="tabpanel">
											    		<div id="comments{{$i}}"></div>
												      	{{ Form::open(array('id' => 'form_koment', 'role' => 'form')) }}
												      	{{ Form::hidden('post_id', $row->id, array('id' => 'post_id'.$i)) }}
												      	<input type="hidden" name="full_name" id="full_name{{$i}}" value="{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}">
												      	{{ Form::text('comment', null, array('class' => 'form-control form-control-sm', 'placeholder' => 'Komentar anda.', 'id' => 'comment'.$i)) }}
												      	<div class="clear"></div>
												      	{{ Form::close() }}
												      	<button type="button" id="komentar{{$i}}" class="btn btn-secondary btn-sm" style="margin-top: 5px">Koment</button>
											    	</div>
											  	</div>
											</div>
										</div>
									</div>
									<?php $i++;?>
								{{-- @endforeach --}}
								@endif
							@endforeach
						@else
							@foreach($posting as $row)
								@if(count($row->posting) < 1)
								<div class="media">
									<div class="media-body">
									    Anda belum memposting sesuatu..
									</div>
								</div>
								@else
								{{-- @foreach($row->posts as $post) --}}
							  		<div class="media">
										<img class="mr-3 rounded" src="{{ asset($row->foto) }}" alt="Foto 64x64" style="max-width: 64px; max-height: 64px">
										<div class="media-body">
										    <h5 class="mt-0">{{ $row->first_name }} {{ $row->last_name }}</h5>
										    <p>
										    	{{ $row->posting }}
											</p>
											<div class="float-sm-right">
												{{ Form::open(array('route' => array('user.destroy', $row->id), 'method' => 'delete')) }}
												<a href="#" class="btn btn-secondary btn-sm">Edit</a>
												{{ Form::submit('Hapus', array('class' => 'btn btn-secondary btn-sm')) }}
												{{ Form::close() }}
											</div>
											<div id="exampleAccordion" data-children=".item">
											  	<div class="item">
											    	<small>{{ Sentinel::getUser()->created_at }}</small>
											    	<a data-toggle="collapse" data-parent="#exampleAccordion" href="#exampleAccordion{{$i}}" aria-expanded="false" aria-controls="exampleAccordion{{$i}}" class="btn btn-secondary btn-sm float-right" style="margin-bottom: 5px; margin-right: 5px">
											    		<div id="banyak_komentar{{$i}}">Komentar</div>
											    	</a>
											    	<div id="exampleAccordion{{$i}}" class="collapse" role="tabpanel">
											    		<div id="comments{{$i}}"></div>
												      	{{ Form::open(array('id' => 'form_koment', 'role' => 'form')) }}
												      	{{ Form::hidden('post_id', $row->id, array('id' => 'post_id'.$i)) }}
												      	<input type="hidden" name="full_name" id="full_name{{$i}}" value="{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}">
												      	{{ Form::text('comment', null, array('class' => 'form-control form-control-sm', 'placeholder' => 'Komentar anda.', 'id' => 'comment'.$i)) }}
												      	<div class="clear"></div>
												      	{{ Form::close() }}
												      	<button type="button" id="komentar{{$i}}" class="btn btn-secondary btn-sm" style="margin-top: 5px">Koment</button>
											    	</div>
											  	</div>
											</div>
										</div>
									</div>
									<?php $i++;?>
								{{-- @endforeach --}}
								@endif
							@endforeach
						@endif
				  	</div>
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
</script>

<script>
	<?php for($i=0;$i<count($posting);$i++){?>
	var $id{{$i}} = $('#post_id{{$i}}').val();
	setInterval(function(){
	$.ajax({
        type: 'GET',
        url: '/user_comment/'+$id{{$i}},
        dataType: 'json',
        success: function(data) {
        	var html='';
            for(var i=0;i<data.length;i++){
            	html+='<div class="media">' +
			      	'<a class="pr-3" href="#">'+
			        	'<img class="mr-3 rounded" src="{{ asset('img/1.jpg') }}" alt="Foto 64x64" style="max-width: 64px; max-height: 64px">'+
			      	'</a>'+
			      	'<div class="media-body">'+
			        	'<h5 class="mt-0"><small>'+data[i].full_name+'</small></h5>'+
			        	'<p class="mb-3">'+
			        		'<small>'+
						    	data[i].comment+    
					        '</small>'+
				        '</p>'+
			      	'</div>'+
			    '</div>';
            }
            $("#banyak_komentar{{$i}}").html(data.length+' Komentar');
            $("#comments{{$i}}").html(html);
        },
        error: function (xhr, status){
		console.log(xhr.error);
		}
    });
	}, 5000);
    var _token = $('meta[name="_token"]').attr('content');
    
	
	
    $('#komentar{{$i}}').on('click', function(event){
        $.ajax({
            type: 'POST',
            url: '/user_comment',
            dataType: 'json',
            data: {
                '_token': $('input[name=_token]').val(),
                'full_name': $('#full_name{{$i}}').val(),
                'post_id': $('#post_id{{$i}}').val(),
                'comment': $('#comment{{$i}}').val(),
            },
            success: function(data) {
            	$('#comment{{$i}}').val(' ');
            	window.alert('Berhasil di tambahkan');
            },
            error: function (xhr, status){
			console.log(xhr.error);
			}
        });
    });
    <?php }?>
</script>
@endsection