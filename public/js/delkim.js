var kims = {};


function change(checkbox) {
	kims[checkbox.value] = checkbox.checked;
}


function getJSON(id) {
	var json = document.getElementById(id);
	json = json.getAttribute('value');
	json = JSON.parse(json);
	return json;
}

function setJSON(id,data) {
	var json = document.getElementById(id);
	json.setAttribute('value',data);
}


async function delete_kims() {
	var kims_to_delete = [];
	for(var i in kims) {
		if(kims[i]) {
			kims_to_delete.push(i);
		}
	}
	kims_to_delete = JSON.stringify(kims_to_delete);
	var form = new FormData();
	form.set('json',kims_to_delete);
	var url = '/admin/delkim/delete';
	var promise = await fetch(url,{
		method: 'post',
		body: form,
	});
	if(promise.ok) {
		var response = await promise.text();
	}
	else {
		var response = 'error';
	}
	if(response=='1') {
		kims_to_delete = JSON.parse(kims_to_delete);
		for(var i in kims_to_delete) {
			document.getElementById(kims_to_delete[i]).hidden = true;
		}
	}
}


function build_table(kims_json) {
	var table = document.getElementById('table');
	table.innerHTML = `
		<tr>
			<td>
				Номер КИМ
			</td>
			<td>
				Галочка
			</td>
		</tr>
	`;
	for(var i in kims_json) {
		table.innerHTML += `
			<tr id="`+kims_json[i]+`">
				<td>
					`+kims_json[i]+`
				</td>
				<td>
					<input type='checkbox' value='`+kims_json[i]+`' onchange='change(this)'></input>
				</td>
			</tr>
		`
	}
}


build_table(getJSON('get'));