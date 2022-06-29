var NadiaSite = new class {
    constructor() {
        this.open = false;
        this.nadia = localforage.createInstance({ name: "Nadia" });
        this.nadia.getItem("Client.Account", function (err, value) {
            document.getElementById("avatar_div").onclick = function () { location.href = 'connect.php'; };
            if (value != undefined) {
                var data = PcJsApi_Nadia.AutoConnectAccount(
                    "lE1YmOBovRjJQWdbkwxfPLuIn",
                    value["Token"],
                    value["A-Token"]);
                if (!Object.keys(data).includes("Error")) {
                    NadiaSite.nadia.setItem("Client.Account", data);
                    document.getElementById("avatar_div").onclick = function () { NadiaSite.viewConnect(); };
                    NadiaSite.token = value["Token"];
                    NadiaSite.Atoken = value["AToken"];
                } else { NadiaSite.nadia.removeItem("Client.Account"); }
            }
            NadiaSite.rechargeImg();
        });
    }

    viewConnect() {
        if (this.open) {
            document.getElementById("listA").style = "display: none;";
            this.open = false;
        } else {
            document.getElementById("listA").style = "display: flex";
            this.open = true;
        }
    }

    rechargeImg(id = "avatar_img") {
        var img_data = PcJsApi_Nadia.GetImage(this.token)
        if (img_data == -1 || img_data == null) {
            document.getElementById(id).src = "img/connect.jpg";
        } else { document.getElementById(id).src = "data:image/png;base64," + img_data; }
    }

    deco() {
        this.nadia.removeItem("Client.Account");
        location.href = "index.php";
    }

    changeImg(img) {

    }

    changePasswd() {
        location.href = "changePasswd.php";
    }
}();