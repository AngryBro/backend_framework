var kims_api = '/api/kims';
var KIMS_TO_DELETE = {};

loadKims();

function loadKims() {
	get_async_json(kims_api,build_table);
}

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
	KIMS_TO_DELETE = {};
	send_async_json('/admin/delkims',kims,loadKims);
}

function build_table(kims) {
	var temp = [];
	for(var i in kims) {
		temp.push(kims[i]['name']);
	}
	kims = temp;
	var table = document.getElementById('table');
	if(temp.length==0) {
		table.innerHTML = 'КИМы отсутствуют';
	}
	table.innerHTML = `
		<tr>
			<td>
				Идентификатор КИМ
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