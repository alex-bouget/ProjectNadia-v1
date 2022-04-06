var AccountApi = new class {
    constructor(url) {
        this.rcjs = new RcJsApi(url);
    }
    CreateAccount(Username, Password) {
        return this.rcjs.getJsBySystem(
            "CreateAccount", {
                "Username": Username,
                "Password": Password
            }
        );
    }
    AutoConnectAccount(Username, A_Token) {
        return this.rcjs.getJsBySystem(
            "AutoConnectAccount", {
                "Username": Username,
                "A-Token": A_Token
            }
        );
    }
    ConnectAccount(Username, Password) {
        return this.rcjs.getJsBySystem(
            "ConnectAccount", {
                "Username": Username,
                "Password": Password
            }
        );
    }
    ChangePassword(Username, old_password, new_password) {
        return this.rcjs.getJsBySystem(
            "ChangePassword", {
                "Username": Username,
                "old_password": old_password,
                "new_password": new_password
            }
        );
    }
    IfPrincipalServer() {
        return this.rcjs.getJsBySystem(
            "IfPrincipalServer", {
            }
        );
    }
    Lang() {
        return this.rcjs.getJsBySystem(
            "Lang", {
            }
        );
    }
    GetImage(Token) {
        return this.rcjs.getJsBySystem(
            "GetImage", {
                "Token": Token
            }
        );
    }
    GetName(Token) {
        return this.rcjs.getJsBySystem(
            "GetName", {
                "Token": Token
            }
        );
    }
    SearchByName(Username) {
        return this.rcjs.getJsBySystem(
            "SearchByName", {
                "Username": Username
            }
        );
    }
    SendImage(Token, A_Token, Img) {
        return this.rcjs.getJsBySystem(
            "SendImage", {
                "Token": Token,
                "A-Token": A_Token,
                "Img": Img
            }
        );
    }
}("api/client/");