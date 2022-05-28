<html>
	<head>
		<title>Тест</title>
		<script defer src='/js/test.js'></script>
		<link rel='stylesheet' href='/css/test.css'>
	</head>
	<body>
		<div hidden id='json'><?php echo $json ?></div>
		<h1>Тестовая страница</h1>
		<table class='app'>
			<tr>
				<td style='overflow:scroll'>
					<table id='buttons' style='display:block;height:800px;width:60px'>
					</table>
				</td>
				<td style='width:800px;height:800px'>
				<img id='img' alt='картинка'>
				</td>
				<td id='input_ans'>
					<table style='height:800px'>
						<tr valign='top'>
							<td style='height:200px'>
								<textarea id='answer' onclick='enable_button("save","save")' onchange='enable_button("save","save")'></textarea>
							</td>
						</tr>
						<tr valign='top'>
							<td>
								<table>
									<tr>
										<td>
											<button class='clear' id='clear' onclick='del(answer)'>Очистить</button>
										</td>
										<td>
											<button class='save' id='save' onclick='save(answer.value)'>Сохранить</button>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr valign='bottom'>
							<td>
								<form action='/test' method='post'>
									<input id='saved_answers' hidden name='json' value=''></input>
								<button class='end' type='submit'>Завершить экзамен</button>
								</form>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>