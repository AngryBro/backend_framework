var users = [];
function change(checkbox) {
	if(checkbox.checked) {
		users.push(checkbox.value);
	}
	else {
		var temp = [];
		for(var i = 0; i<users.length; i++) {
			if(users[i]!=checkbox.value) {
				temp.push(users[i]);
			}
		}
		users = temp;
	}
	var input = document.getElementById('json');
	input.setAttribute('value',JSON.stringify(users));
}