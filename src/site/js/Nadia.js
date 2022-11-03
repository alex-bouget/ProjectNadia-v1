var PcJsApi_Nadia = new class {
    constructor(url) {
        this.rcjs = new RcJsApi(url);
    }
    GetTempToken(appKey, appSecret) {
        return this.rcjs.getJsBySystem(
            "GetTempToken", {
                "appKey": appKey,
                "appSecret": appSecret
            }
        );
    }
    AutoConnectAccount(AppId, Token, AToken) {
        return this.rcjs.getJsBySystem(
            "AutoConnectAccount", {
                "AppId": AppId,
                "Token": Token,
                "A-Token": AToken
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
    SearchByName(Username, AppId) {
        return this.rcjs.getJsBySystem(
            "SearchByName", {
                "Username": Username,
                "AppId": AppId
            }
        );
    }
}("api/");