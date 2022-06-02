<html>
	<head>
		<title>Удалить КИМ</title>
		<meta id='json' value='<?php echo $kims ?>'>
		<script defer src='/js/delkim.js'></script>
		<script defer src='/js/async_forms.js'></script>
	</head>
	<body>
		<h1><a href='/admin'>Удалить КИМ</a></h1>
			<table id='table'>
				
			</table>
			<button onclick='delete_kims()'>Удалить</button>
	</body>
</html>