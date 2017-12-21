<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="box-shadow: 0px 0.5px 10px; background-color: rgba(222, 222, 222, 0.34);">
	<div class="container">
		<a class="navbar-brand" href="/">Eaa!!<b>Dashboard</b></a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>
	  	<div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav ml-auto">
		      	<li class="nav-item dropdown">
		        	<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		        		Halo, {{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}
		        	</a>
		        	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          	{!! link_to(route('user.index'), "Home", array('class' => 'dropdown-item')) !!}
			          	{!! link_to(route('user.create'), "Beranda", array('class' => 'dropdown-item')) !!}
			          	{!! link_to(url('/'), "Daftar Pengguna", array('class' => 'dropdown-item')) !!}
			          	<div class="dropdown-divider"></div>
			          	{!! link_to(route('user.edit', Sentinel::getUser()->id), "Edit Profile", array('class' => 'dropdown-item')) !!}
			          	<div class="dropdown-divider"></div>
			          	{!! link_to(route('logout'), "Keluar", array('class' => 'dropdown-item')) !!}
			        </div>
		      	</li>
		    </ul>
	  	</div>
	</div>
</nav>