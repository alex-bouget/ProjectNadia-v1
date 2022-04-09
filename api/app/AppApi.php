<?php
include_once __DIR__ . "/../database.php";

class AppAPI
{

    protected $_Api;

    public function __construct()
    {
        $this->_Api = new MyDB();
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

    public function have_account($GToken, $AppId) {
        $res = $this->_Api->decode_result(
            $this->_Api->execute(
                file_get_contents(__DIR__ . "/sql/have_account.sql"),
                [$AppId, $GToken]
            )
        );
        var_dump($res);
        return (count($res) == 1)?$res[0]:false;
    }

    public function getAppName($AppId) {
        $res = $this->_Api->decode_result(
            $this->_Api->execute(
                file_get_contents(__DIR__ . "/sql/get_app_name.sql"),
                [$AppId]
            )
        );
        return $res[0][0];
    }

    public function addApp($AppName, $description, $userToken, $AToken) {
        $user = $this->TestConnection($userToken, $AToken);
        if (is_string($user)) {
            return $user;
        }
        $params = array(
            $this->get_token(25, "AId"),
            $this->get_token(75, "Secret"),
            $AppName,
            $description,
            $userToken
        );
        $this->_Api->execute(
            file_get_contents(__DIR__ . "/sql/add_app.sql"),
            $params
        );
        $this->addAccount($params[0], $userToken, $AToken, "Admin");
        return json_encode(array("AppId" => $params[0], "Secret" => $params[1]));
    }

    public function addAccount($AppId, $userToken, $AToken, $right="User") {
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

        $this->_Api->execute(
            file_get_contents(__DIR__ . "/sql/add_account.sql"),
            $params
        );
        return json_encode(array(
            "Token" => $params[1],
            "A-Token" => $params[2]
        ));
    }
}
