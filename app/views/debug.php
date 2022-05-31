<html>
	<head>
		<title>Debug</title>
	</head>
	<body>
		<h1>Отладка</h1>
		<input name='key'></input>
		<script>
			async function debug() {
				var form = new FormData();
				form.set('key','value');
				var url = '/debug/send';
				var promise = await fetch(url,{
					method: 'post',
					body: form
				});
				console.log(promise.ok);
			}
		</script>
	</body>
</html>