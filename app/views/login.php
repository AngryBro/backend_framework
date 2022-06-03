<html>
	<head>
		<title>Авторизация</title>
		<script defer src='/js/async_forms.js'></script>
		<script defer src='/js/login.js'></script>
	</head>
	<body>
		<h1>Авторизация пользователя</h1>
			<table>
			<form id='form'>
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
			</form>
				<tr>
					<td>
					</td>
					<td>
						<button onclick='login()'>Войти</button>
					</td>
				</tr>
			</table>
	</body>
</html>