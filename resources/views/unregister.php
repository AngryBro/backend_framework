<html>
	<head>
		<title>Удалить</title>
		<?php
			include '../app/srcLoader.php';
			script('unregister');
			if(isset($alert)) {
				echo $alert;
			}
		?>
	</head>
	<body>
		<h1><a href='/admin'>Удалить пользователя</a></h1>
		<table>
			<tr>
				<td>
					Пользователь
				</td>
				<td>
					Галочка
				</td>
			</tr>
			<?php
				foreach($users as $user) {
					if(($user!='admin')&&($user!='user')) {
						echo 
						'<tr>'.
							'<td>'.
								$user.
							'</td>'.
							'<td>'.
								'<input value="'.$user.'" type="checkbox" onchange="change(this)"></input>'.
							'</td>'
						.'</tr>' ;
					}
				}
			?>
		</table>
		<form method='post' action='/admin/unregister'>
			<input name='json' hidden id='json'></input>
			<button type='submit'>Удалить</button>
		</form>
	</body>
</html>