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
				<td valign='top'>
					<table>
						<tr>
							<td>
								<textarea id='answer' onclick='enable_button("save","save")' onchange='enable_button("save","save")'></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<table>
									<tr>
										<td>
											<button class='clear' id='clear' onclick='del(answer)'>Очистить</button>
										</td>
										<td>
											<button class='save' id='save' onclick='save(current_task.value,answer.value,this)'>Сохранить</button>
										</td>
										<td>
											<input hidden id='current_task' value='0'></input>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>