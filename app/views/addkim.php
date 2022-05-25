<html>
	<head>
		<title>Добавить КИМ</title>
		<?php
			echo $alert;
		?>
	</head>
	<body>
		<h1><a href='/admin'>Добавить КИМ</a></h1>
		<form method='post' enctype='multipart/form-data' action='/admin/addkim'>
			<table>
				<tr>
					<td>
						Номер КИМ:
					</td>
					<td>
						<input name='kim'></input>
					</td>
				</tr>
				<tr>
					<td>
						zip архив:
					</td>
					<td>
						<input type='file' name='zip'></input>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<button type='submit'>Добавить</button>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>