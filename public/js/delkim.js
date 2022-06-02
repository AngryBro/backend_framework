var KIMS_TO_DELETE = {};
build_table(JSON.parse(document.getElementById('json').getAttribute('value')));

function change(checkbox) {
	KIMS_TO_DELETE[checkbox.value] = checkbox.checked;
}

function delete_kims() {
	var kims = [];
	for(var i in KIMS_TO_DELETE) {
		if(KIMS_TO_DELETE[i]) {
			kims.push(i);
		}
	}
	send_async_json('/admin/delkim/delete',kims,build_table);
}

function build_table(kims) {
	var table = document.getElementById('table');
	table.innerHTML = `
		<tr>
			<td>
				Номер КИМ
			</td>
			<td>
				Отметка на удаление
			</td>
		</tr>
	`;
	for(var i in kims) {
		table.innerHTML += `
			<tr id="`+kims[i]+`">
				<td>
					`+kims[i]+`
				</td>
				<td>
					<input type='checkbox' value='`+kims[i]+`' onchange='change(this)'></input>
				</td>
			</tr>
		`
	}
}


build_table(getJSON('get'));