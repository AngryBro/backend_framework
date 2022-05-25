<html>
	<head>
		<title>Удалить КИМ</title>
		<script defer src='/js/delkim.js'></script>
	</head>
	<body>
		<h1><a href='/admin'>Удалить КИМ</a></h1>
		<div hidden id='get'><?php echo $kims ?></div>
		<form method='post' action='/admin/delkim'>
			<table id='table'>
				<tr>
					<td>
						Номер КИМ
					</td>
					<td>
						Галочка
					</td>
				</tr>
				
			</table>
			<input hidden id='post' name='json'></input>
		</form>
	</body>
</html>