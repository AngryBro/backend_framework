class ApiRequest {
    constructor(url = '/api'+new URL(window.location).pathname) {
        this.url = url;
    }
    _objectToForm(object) {
        var form = new FormData();
        form.set('json',JSON.stringify(object));
        return form;
    }
    async getJSON(func) {
        var promise = await fetch(this.url);
        var status = promise.status;
        var ok = promise.ok;
        var response = await promise.json();
        var data = {ok:ok,status:status,data:response};
        func(data);
    }
    async postJSON(object,func) {
        var promise = await fetch(this.url,{
            method: 'post',
            body: this._objectToForm(object)
        });
        if(arguments.length<=1) {
            return;
        }
        var status = promise.status;
        var ok = promise.ok;
        var response = await promise.json();
        var data = {ok:ok,status:status,data:response};
        func(data);
    }
    async postForm(func) {
        var promise = await fetch(this.url,{
            method: 'post',
            body: new FormData(document.querySelector('form'))
        });
        if(arguments.length==0) {
            return;
        }
        var status = promise.status;
        var ok = promise.ok;
        var response = await promise.json();
        var data = {ok:ok,status:status,data:response};
        func(data);
    }
}