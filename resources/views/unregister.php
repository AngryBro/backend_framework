<html>
	<head>
		<title>Удалить</title>
		<script>
			var users = [];
			function change(checkbox) {
				if(checkbox.checked) {
					users.push(checkbox.value);
				}
				else {
					var temp = [];
					for(var i = 0; i<users.length; i++) {
						if(users[i]!=checkbox.value) {
							temp.push(users[i]);
						}
					}
					users = temp;
				}
				var input = document.getElementById('json');
				input.setAttribute('value',JSON.stringify(users));
			}
		</script>
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
			?>
		</table>
		<form method='post' action='/admin/unregister/submit'>
			<input name='json' hidden id='json'></input>
			<button type='submit'>Удалить</button>
		</form>
	</body>
</html>