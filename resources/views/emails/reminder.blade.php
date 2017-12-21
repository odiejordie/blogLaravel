<body>
	<h3>Hello {{ $detail['email'] }}</h3>
	<p>
		Seseorang ada yang meminta untuk ganti password,
		<br/>
		jika bukan anda, abaikan saja email ini!!
		<br />
		tapi jika ini anda, tolong klik link dibawah untuk mengikuti langkah selanjutnya..
		<br>
		reset#Eaa!!
	</p>
	{!! link_to(route('reminders.edit', ['id' => $detail['id'], 'code' =>
	$detail['code']]), 'Click me') !!}
	<h2>Terimakasih.</h2>
</body>