<html>
	<head>
		<title>Results</title>
		<script defer src='/js/async_forms.js'></script>
		<script defer src='/js/results.js'></script>
	</head>
	<body>
		<h1><a href='/admin'>Результаты тестов</a></h1>
		<table id='table'>
			<tr>
				<td>
					№
				</td>
				<td>
					Пользователь
				</td>	
				<td>
					КИМ
				</td>
				<td>
					Отметка на удаление
				</td>
			</tr>
		</table>
		<br><br>
		<button hidden id='delete_button' onclick="delete_results()">Удалить</button>
	</body>
</html>