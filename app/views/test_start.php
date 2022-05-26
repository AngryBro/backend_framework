<html>
	<head>
		<title>Начать</title>
		<link rel='stylesheet' href='/css/test.css'>
	</head>
	<body>
		<h1>КИМ <?php echo $json ?></h1>
		<form method='post' action='/test'>
			<input hidden name='ready' value='ready'></input>
			<button type='submit' class='start'>Начать экзамен</button>
		</form>
	</body>
</html>