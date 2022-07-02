var USERS_TO_DELETE = {};
var users_api = '/api/users';
loadUsers();

function loadUsers() {
	get_async_json(users_api,build_table);
}

function delete_users() {
	var users = [];
	for(var i in USERS_TO_DELETE) {
		if(USERS_TO_DELETE[i]) {
			users.push(i);
		}
	}
	send_async_json('/admin/unregister',users,loadUsers);
}

function check_to_delete(checkbox) {
	USERS_TO_DELETE[checkbox.value] = checkbox.checked;
}

function build_table(users) {
	USERS_TO_DELETE = {};
	var emails = [];
	for(var i in users) {
		emails.push(users[i]['email']);
	}
	users = emails;
	var table = document.getElementById('table');
	if(emails.length==0) {
		table.innerHTML = 'Пользователи отсутствуют';
		return;
	}
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