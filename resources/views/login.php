<html>
	<head>
		<title>Авторизация</title>
		<script>
			<?php
				echo $alert;
			?>
		</script>
	</head>
	<body>
		<h1>Авторизация пользователя</h1>
		<form method='post' action='/login/submit'>
			<table>
				<tr>
					<td>
						Логин:
					</td>
					<td>
						<input name='login'></input>
					</td>
				</tr>
				<tr>
					<td>
						Пароль:
					</td>
					<td>
						<input name='password'></input>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<button type='submit'>Войти</button>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>