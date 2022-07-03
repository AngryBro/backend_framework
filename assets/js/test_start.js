API = '/api/kim';
async_get_json(API,setKimName);


function setKimName(name) {
    var h1 = document.querySelector('h1');
    h1.innerHTML += ' '+name;
}