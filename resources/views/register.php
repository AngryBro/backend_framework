<html>
	<head>
		<title>Регистрация</title>
	</head>
	<body>
		<h1><a href='/admin'>Регистрация пользователя</a></h1>
		<form method='post' action='/admin/register/submit'>
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
						<button type='submit'>Зарегистрировать</button>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>