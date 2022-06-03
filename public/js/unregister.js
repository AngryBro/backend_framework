var USERS_TO_DELETE = {};
get_async_json('/admin/unregister/users',build_table);

function delete_users() {
	var users = [];
	for(var i in USERS_TO_DELETE) {
		if(USERS_TO_DELETE[i]) {
			users.push(i);
		}
	}
	send_async_json('/admin/unregister/delete',users,build_table);
}

function check_to_delete(checkbox) {
	USERS_TO_DELETE[checkbox.value] = checkbox.checked;
}

function build_table(users) {
	USERS_TO_DELETE = {};
	var table = document.getElementById('table');
	table.innerHTML = `
		<tr>
			<td>
				Пользователь
			</td>
			<td>
				Отметка на удаление
			</td>
		</tr>
	`;
	for(var i in users) {
		table.innerHTML += `
			<tr>
				<td>`+users[i]+`</td>
				<td><input onchange="check_to_delete(this)" type="checkbox" value="`+users[i]+`"></input></td>
			</tr>
		`;
	}
}