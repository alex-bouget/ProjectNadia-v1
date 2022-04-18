<?php
include_once __DIR__ . "/../database.php";
include_once __DIR__ . "/../gigly.php";

class AppAPI
{

    protected $_Api;
    protected $TempToken;

    public function __construct()
    {
        $this->_Api = new MyDB();
        if (file_exists(__DIR__ . "/tempToken.json")) {
            $this->TempToken = json_decode(file_get_contents(__DIR__ . "/tempToken.json"), true);
        } else {
            $this->TempToken = [];
        }
        foreach ($this->TempToken as $AppId => $allCouple) {
            foreach ($allCouple as $keyCouple => $couple) {
                if (time() > $couple[1]) {
                    unset($this->TempToken[$AppId][$keyCouple]);
                }
            }
        }
        $this->save_file();
    }

    protected function save_file()
    {
        file_put_contents(__DIR__ . "/tempToken.json", json_encode($this->TempToken));
    }

    protected function TestConnection($userToken, $Atoken)
    {
        $user = $this->_Api->decode_result(
            $this->_Api->execute(
                file_get_contents(__DIR__ . "/../client/sql/connection_token.sql"),
                [$userToken, $Atoken]
            )
        );
        if (count($user) == 0) {
            return json_encode(array("Error" => "Can't connect to your account"));
        }
        return $user[0];
    }

    private function get_token($length, $token_name)
    {
        $token = create_token($length);
        $res = $this->_Api->decode_result(
            $this->_Api->execute(
                file_get_contents(__DIR__ . "/sql/get_" . $token_name . ".sql"),
                [$token]
            )
        );
        if ($res !== false && count($res) != 0) {
            return $this->get_token($length, $token_name);
        }
        return $token;
    }

    public function have_account($GToken, $AppId)
    {
        $res = $this->_Api->decode_result(
            $this->_Api->execute(
                file_get_contents(__DIR__ . "/sql/have_account.sql"),
                [$AppId, $GToken]
            )
        );
        return json_encode((count($res) == 1) ? $res[0] : array("Error" => "You don't have account"));
    }

    public function getTempToken($AppId, $appSecret)
    {
        $res = $this->_Api->decode_result(
            $this->_Api->execute(
                file_get_contents(__DIR__ . "/sql/test_app.sql"),
                [$AppId, $appSecret]
            )
        );
        if (count($res) == 0) {
            return json_encode(array("Error" => "App doesn't exist"));
        }
        $TempToken = create_token(10);
        $this->TempToken[$AppId][] = [$TempToken, time() + 600];
        $this->save_file();
        return json_encode(array("appId" => $AppId, "TempToken" => $TempToken));
    }

    public function testTempToken($AppId, $TempToken)
    {
        if (!isset($this->TempToken[$AppId])) {
            return json_encode(array("Error" => "App doesn't exist"));
        }
        foreach ($this->TempToken as $AppId => $allCouple) {
            foreach ($allCouple as $keyCouple => $couple) {
                if ($couple[0] == $TempToken && $couple[1] > time()) {
                    return json_encode(array("appId" => $AppId, "TempToken" => $TempToken));
                }
            }
        }
        return json_encode(array("Error" => "TempToken doesn't exist"));
    }

    public function AutoConnectAccount($AppId, $UserName, $AToken)
    {
        $res = $this->_Api->decode_result(
            $this->_Api->execute(
                file_get_contents(__DIR__ . "/../client/sql/get_username.sql"),
                [$UserName]
            )
        );
        if (count($res) != 1) {
            return json_encode(array("Error" => "Account not exist"));
        }
        $res = $this->_Api->decode_result(
            $this->_Api->execute(
                file_get_contents(__DIR__ . "/sql/connect_app_account.sql"),
                [$res[0][0], $AppId, $AToken]
            )
        );
        if (boolval(count($res))) {
            return json_encode(array(
                "UserName" => $res[0][1],
                "Token" => $res[0][0],
                "A-Token" => $res[0][2],
            ));
        }
        return json_encode(array("Error" => "bad token"));
    }

    public function getAppName($AppId)
    {
        $res = $this->_Api->decode_result(
            $this->_Api->execute(
                file_get_contents(__DIR__ . "/sql/get_app_name.sql"),
                [$AppId]
            )
        );
        return json_encode(array("Name" => $res[0][0]));
    }

    public function addApp($AppName, $description, $userToken, $AToken)
    {
        $user = $this->TestConnection($userToken, $AToken);
        if (is_string($user)) {
            return $user;
        }
        $params = array(
            $this->get_token(25, "AId"),
            $this->get_token(70, "Secret"),
            $AppName,
            $description,
            $userToken
        );
        $this->_Api->execute(
            file_get_contents(__DIR__ . "/sql/add_app.sql"),
            $params
        );
        $this->addAccount($params[0], $userToken, $AToken, "Admin");
        $this->TempToken[$params[0]] = array();
        $this->save_file();
        return json_encode(array("AppId" => $params[0], "Secret" => $params[1]));
    }

    public function addAccount($AppId, $userToken, $AToken, $right = "User")
    {
        $user = $this->TestConnection($userToken, $AToken);
        if (is_string($user)) {
            return $user;
        }
        $params = array(
            $AppId,
            $userToken,
            $this->get_token(60, "AToken"),
            date('Y-m-d', time() + 604800),
            $right
        );

        echo $this->_Api->execute(
            file_get_contents(__DIR__ . "/sql/add_account.sql"),
            $params
        );
        return json_encode(array(
            "Token" => $params[1],
            "A-Token" => $params[2]
        ));
    }
}
