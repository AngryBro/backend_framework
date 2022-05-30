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
				var response = await fetch(url,{
					method:'POST',
					body:form,
					headers: {
						'Content-Type': 'form/multipart'
					}
				});
			}
		</script>
	</body>
</html>