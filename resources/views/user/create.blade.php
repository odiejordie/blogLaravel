@extends('layout.layout')

@section('navbar')

	@include('user.navbar')	

@endsection

@section('content')
<div class="container" style="padding-top: 60px">
	<div class="row">
		<div class="col-sm-8 offset-sm-2">
			<div class="card">
			  	<div class="card-body">
			  		{{ Form::open(array('route' => 'user.store')) }}
				  		{{ Form::hidden('user_id', Sentinel::getUser()->id) }}
			    		{{ Form::text('posting', null, array('class' => 'form-control', 'placeholder' => 'Apa yang anda pikirkan?')) }}
			    		{{ Form::submit('Post', array('class' => 'btn btn-secondary col-sm-2 float-sm-right', 'style' => 'margin-top:10px')) }}
			  		{{ Form::close() }}
			  	</div>
			</div>
			<div class="card" style="margin-top: 10px">
			  	<div class="card-body">
			  		<?php $i = 0;?>
			  		@foreach($posting as $row)
			  		<div class="media">
						<img class="mr-3 rounded" src="{{ asset('img/1.jpg') }}" alt="Foto 64x64" style="max-width: 64px; max-height: 64px">
						<div class="media-body">
						    <h5 class="mt-0">{{ $row->user->first_name }} {{ $row->user->last_name }}</h5>
						    <p>
							    {{ $row->posting }}
							</p>
							<div id="exampleAccordion" data-children=".item">
							  	<div class="item">
							    	<small>{{ Sentinel::getUser()->created_at }}</small>
							    	<a data-toggle="collapse" data-parent="#exampleAccordion" href="#exampleAccordion{{$i}}" aria-expanded="false" aria-controls="exampleAccordion{{$i}}" class="btn btn-secondary btn-sm float-right" style="margin-bottom: 5px">
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
					@endforeach
			  	</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
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

