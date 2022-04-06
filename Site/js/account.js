const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}

var Account = new class {
    constructor() {
        this.open = false;
        this.paramsAddOpen = false;
        this.search = "";
        this.gigly = localforage.createInstance({ name: "Gigly" });
        this.gigly.getItem("Client.Account", function (err, value) {
            document.getElementById("avatar_div").onclick = function () { location.href = 'connect.php'; };
            if (value != undefined) {
                var data = ClientApi.AutoConnectAccount(value["UserName"], value["A-Token"]);
                if (!Object.keys(data).includes("Error")) {
                    Account.gigly.setItem("Client.Account", data);
                    document.getElementById("avatar_div").onclick = function () { Account.viewConnect(); };
                    Account.token = value["Token"];
                    Account.Atoken = value["A-Token"];
                    Account.reloadBattle();
                } else { Account.gigly.removeItem("Client.Account"); }
            }
            Account.rechargeImg();
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
        this.gigly.getItem("Client.Account", function (err, value) {
            var img_data = ClientApi.GetImage(value["Token"])
            if (img_data == -1 || img_data == null) {
                document.getElementById(id).src = "img/connect.jpg";
            } else { document.getElementById(id).src = "data:image/png;base64," + img_data; }
        });
    }
    async changeImg(file) {
        if (file.size > 2097152) { return; }
        var base64 = await toBase64(file);
        var account = await this.gigly.getItem("Client.Account");
        ClientApi.SendImage(account["Token"], account["A-Token"], base64.split(",")[1]);
    }
    async changePassw() {
        var oldpass = document.getElementById("oldPass").value;
        var newpass = document.getElementById("newPass").value;
        if (newpass != document.getElementById("newPass2").value) { return; }
        var account = await this.gigly.getItem("Client.Account");
        var data = ClientApi.ChangePassword(account["UserName"], oldpass, newpass);
    }
    deco() {
        this.gigly.removeItem("Client.Account");
        location.href = "index.php";
    }
    createButton() {
        var type = document.getElementById("type").value;
        var user = document.getElementById("user").value;
        var pass = document.getElementById("pass").value;
        if (type == "create") {
            if (pass != document.getElementById("pass2").value) { return; }
            var data = ClientApi.CreateAccount(user, pass);
        } else { var data = ClientApi.ConnectAccount(user, pass); }
        if (data["Error"] == undefined) {
            this.gigly.setItem("Client.Account", data);
            location.href = "index.php";
        }
    }
}();