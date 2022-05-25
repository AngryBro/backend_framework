var kims = [];
var existing_kims;
function change(checkbox) {
	if(checkbox.checked) {
		kims.push(checkbox.value);
	}
	else {
		var temp = [];
		for(var i = 0; i<kims.length; i++) {
			if(kims[i]!=checkbox.value) {
				temp.push(kims[i]);
			}
		}
		kims = temp;
	}
	var input = document.getElementById('post');
	input.setAttribute('value',JSON.stringify(users));
}
function getJSON(id) {
	json = document.getElementById(id);
	json = json.innerHTML;
	json = JSON.parse(json);
	existing_kims = json;
}
function build_table(kims) {
	var table = document.getElementById('table');
	for(var i = 0; i<kims.length; i++) {
		table.innerHTML += `
			<tr>
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