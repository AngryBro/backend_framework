<html>
	<head>
		<title>Result</title>
		<meta id='json' content='<?php echo $json ?>'>
		<script defer src='/js/single_result.js'></script>
		<link rel='stylesheet' href='/css/single_result.css'>
	</head>
	<body>
		<h1 id='title'></h1>
		<table id='table'>
			<tr id='numbers'>
				<th>
					Номер задания
				</th>
			</tr>
			<tr id='actual_answers'>
				<th>
					Данный ответ
				</th>
			</tr>
			<tr id='correct_answers'>
				<th>
					Верный ответ
				</th>
			</tr>
		</table>
	</body>
</html>