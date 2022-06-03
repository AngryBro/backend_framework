async function send_async_json(url,obj,func) {
    var promise = await fetch(url,{
        method: 'post',
        body: to_form(obj)
    });
    var response = await promise.json();
    func(response);
}

async function get_async_json(url,func) {
    var promise = await fetch(url);
    var response = await promise.json();
    func(response);
}

function to_form(obj) {
    var form = new FormData();
    form.set('json',JSON.stringify(obj));
    return form;
}