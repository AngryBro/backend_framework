<html>
	<head>
		<title>Debug</title>
	</head>
	<body>
		<h1>Отладка</h1>
		<form id='form' action='/debug/sen' method='post'>
			<input name='key'></input>
			<button type='submit'>gwer</button>
		</form>
		<script>
			async function debug() {
				var form = new FormData(document.getElementById('form'));
				var url = '/index.php';
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