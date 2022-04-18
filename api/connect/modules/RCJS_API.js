class RcJsApi {
    constructor(url) {
        this.url = url;
        const request = new XMLHttpRequest();
        request.open("POST", url + "?MM1_jc=200", false);
        request.send(null);
        this.System = JSON.parse(request.responseText);
    }

    getJsBySystem(name, post_data = null) {
        if (post_data === null) {
            post_data = {};
        }
        var Data = new FormData();
        for (var index in post_data) {
            Data.append(index, post_data[index]);
        }

        function getUrl(url, get_data) {
            var data_get = [];
            for (var data in get_data) {
                data_get.push(data.toString() + "=" + get_data[data].toString());
            }

            return url + "?" + data_get.join("&");
        }

        const request = new XMLHttpRequest();
        request.open("POST", getUrl(this.url, this.System[name]["GET"]), false);
        request.send(Data);
        console.log(request.responseText);
        return JSON.parse(request.responseText);
    }
}
;