async function send_async_json(url,obj,func) {
    var promise = await fetch(url,{
        method: 'post',
        body: to_form(obj)
    });
    if(arguments.length>2) {
        var response = await promise.json();
        func(response);
    }
}

async function get_async_json(url,func) {
    var promise = await fetch(url);
    if(arguments.length>1) {
        var response = await promise.json();
        func(response);
    }
}

async function async_get_json(url,func) {
    var promise = await fetch(url);
    if(arguments.length>1) {
        var response = await promise.json();
        func(response);
    }
}

async function async_post_json(url,obj,func) {
    var promise = await fetch(url,{
        method: 'post',
        body: to_form(obj)
    });
    if(arguments.length>2) {
        var response = await promise.json();
        func(response);
    }
}

async function async_post_form(url,form_id,func) {
    var form = new FormData(document.getElementById(form_id));
    var promise = await fetch(url,{
        method: 'post',
        body: form
    });
    if(arguments.length>2) {
        var response = await promise.json();
        func(response);
    }
}

async function send_async_form(url,form_id,func) {
    var form = new FormData(document.getElementById(form_id));
    var promise = await fetch(url,{
        method: 'post',
        body: form
    });
    if(arguments.length>2) {
        var response = await promise.json();
        func(response);
    }
}

function to_form(obj) {
    var form = new FormData();
    form.set('json',JSON.stringify(obj));
    return form;
}