function XMLsync(url) {
    const request = new XMLHttpRequest();
    request.open("GET", url, false);
    request.send(null);
    return request;
}