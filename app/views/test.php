<html>
	<head>
		<title>Тест</title>
		<script defer src='/js/async_forms.js'></script>
		<script defer src='/js/test.js'></script>
		<link rel='stylesheet' href='/css/test.css'>
		<link rel='stylesheet' href='/css/recheck.css'>
	</head>
	<body>
<div id='start_exam' hidden>
		<button onclick='start()' class='start'>start</button>
</div>
<div id='test' hidden>
		<table class='app' id='app'>
			<tr>
				<td style='overflow:scroll'>
					<table id='buttons' style='display:block;height:800px;width:60px'>
					</table>
				</td>
				<td style='width:800px;height:800px'>
				<img id='img' alt='ошибка загрузки задания'>
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
						<tr>
							<td>
								<ul id="additional_files">
								</ul>
							</td>
						</tr>
						<tr valign='bottom'>
							<td>
								<button class='end' onclick='end()'>Завершить экзамен</button>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
</div>
<div id='end_exam' hidden>
			<table id='answers_table' class="answers">
			</table>
			<br><br>
			<button class="stay" onclick='back_to_test()'>Назад</button>
			<button class="send" onclick='send()'>Отправить</button>
</div>
<div id='sent' hidden>
			<h1>Экзамен завершён</h1>
			Результаты экзамена уже у админа
</div>
	</body>
</html>