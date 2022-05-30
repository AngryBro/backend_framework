<html>
	<head>
		<title>Result</title>
		<meta id='json' content='<?php echo $json ?>'>
		<script defer src='/js/single_result.js'></script>
		<link rel='stylesheet' href='/css/single_result.css'>
	</head>
	<body>
		<h1><a id='header' href='/admin/results'></a></h1>
		<table id='table'>
			<tr>
				<th>Номер</th>
				<th>Данный ответ</th>
				<th id='correct_answers'>Верный ответ</th>
			</tr>
		</table>
		<br><br>
		<button id='trigger' onclick = 'trigger_correct_ans()'>Скрыть верные ответы</button>
	</body>
</html>