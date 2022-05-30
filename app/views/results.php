<html>
	<head>
		<title>Results</title>
		<meta id='json' content='<?php echo $json ?>'>
		<script defer src='/js/results.js'></script>
	</head>
	<body>
		<h1><a href='/admin'>Результаты тестов</a></h1>
		<table id='results'>
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
				<td id='delete'>
					Отметка на удаление
				</td>
			</tr>
		</table>
		<br><br>
		<button hidden id='delete_button' onclick="delete_results()">Удалить</button>
		<form hidden method="post" action='/admin/results' id='form_to_delete'>
			<input id='delete_json' name='delete'></input>
		</form>
	</body>
</html>