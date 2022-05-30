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
	json = json.setAttribute('value',data);
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
	var url = '/admin/delkim/';
	var response = await fetch(url,{
		method:'POST',
		body: form,
		headers: {
			'Content-Type': 'form/multipart'
		}
	}); console.log(form);
	//var r = await response.json(); console.log(r);
	// setJSON('get',r);
	// build_table(getJSON('get'));
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