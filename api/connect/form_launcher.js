function formLauncher(method, action, data) {
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", action);
    form.setAttribute("style", "display:none");
    for (var key of Object.keys(data)) {
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", key);
        input.setAttribute("value", data[key]);
        form.appendChild(input);
    }
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}