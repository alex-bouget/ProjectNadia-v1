<?php

include_once __DIR__ . "/../database.php";
include_once __DIR__ . "/../private/properties.php";
include_once __DIR__ . "/../app/AppApi.php";
include_once __DIR__ . "/../private/Admin_app.php";

class AccountAPI
{
    protected $_Salt;
    protected $_Account_file;
    protected $_T_length;
    protected $_A_length;

    public function __construct()
    {
        $this->_Salt = get_properties("AccountSalt");
        $this->_T_length = get_properties("AccountId_length");
        $this->_A_length = get_properties("AccountAtoken_length");
        $this->_Account_file = new MyDB();
    }

    private function get_token($length, $token_name)
    {
        $token = create_token($length);
        $res = $this->_Account_file->decode_result(
            $this->_Account_file->execute(
                file_get_contents(__DIR__ . "/sql/get_" . $token_name . ".sql"),
                [$token]
            )
        );
        if ($res !== false && count($res) != 0) {
            return $this->get_token($length, $token_name);
        }
        return $token;
    }

    private function augmentDeath($G_token)
    {
        $this->_Account_file->execute(
            file_get_contents(__DIR__ . "/sql/augmentDeath.sql"),
            [date('Y-m-d', time() + 604800), $G_token]
        );
    }

    private function connectionToken($token, $Atoken)
    {
        $res = $this->_Account_file->decode_result(
            $this->_Account_file->execute(
                file_get_contents(__DIR__ . "/sql/connection_token.sql"),
                [$token, $Atoken]
            )
        );
        if (boolval(count($res))) {
            return array(
                "UserName" => $res[0][1],
                "Token" => $res[0][0],
                "A-Token" => $res[0][2],
            );
        }
        return false;
    }

    public function create_account($username, $password)
    {
        global $admin_app;
        $res = $this->_Account_file->decode_result(
            $this->_Account_file->execute(
                file_get_contents(__DIR__ . "/sql/get_username.sql"),
                [$username]
            )
        );
        if ($res != 0) {
            return json_encode(array("Error" => "Account already exist"));
        }
        $params = array(
            $this->get_token($this->_T_length, "GToken"),
            $username,
            crypt($password, $this->_Salt),
            $this->get_token($this->_A_length, "AToken"),
            date('Y-m-d', time() + 90),
            $this->_Account_file->decode_result(
                $this->_Account_file->execute(
                    file_get_contents(__DIR__ . "/sql/get_right_id.sql"),
                    ['User']
                )
            )[0][0]
        );
        $this->_Account_file->execute(
            file_get_contents(__DIR__ . "/sql/create_account.sql"),
            $params
        );
        $app = new AppAPI();
        $data = $app->addAccount($admin_app["AppId"], $params[0], $params[3], "User");
        var_dump($data);
        return json_encode(array(
            "UserName" => $params[1],
            "Token" => $params[0],
            "A-Token" => $params[3]
        ));
    }

    public function connect_account($username, $pass_type, $type_connection)
    {
        global $admin_app;
        $res = $this->_Account_file->decode_result(
            $this->_Account_file->execute(
                file_get_contents(__DIR__ . "/sql/get_username.sql"),
                [$username]
            )
        );
        if ($type_connection == "Password") {
        //PASSWORD
            if (
                count($res) != 1 ||
                !hash_equals($res[0][2], crypt($pass_type, $this->_Salt))
            ) {
                return json_encode(array("Error" => "Account not exist or bad password"));
            }
            $params = array(
                $this->get_token($this->_A_length, "AToken"),
                date('Y-m-d', time() + 604800),
                $res[0][0]
            );
            $this->_Account_file->execute(
                file_get_contents(__DIR__ . "/sql/changeAToken.sql"),
                $params
            );
            return json_encode(array(
                "UserName" => $res[0][1],
                "Token" => $res[0][0],
                "A-Token" => $params[0]
            ));
        } else if ($type_connection == "AdminToken") {
        //ADMIN TOKEN
            $this->_Account_file->decode_result(
                $this->_Account_file->execute(
                    file_get_contents(__DIR__ . "/../app/sql/connect_app_account.sql"),
                    [$admin_app["APPID"], $username, $pass_type]
                )
            );
            if (boolval(count($res))) {
                return json_encode(array(
                    "UserName" => $res[0][1],
                    "Token" => $res[0][0],
                    "A-Token" => $res[0][3],
                ));
            }
            return json_encode(array("Error" => "bad token"));
        } else {
            $test = $this->connectionToken($res[0][0], $pass_type);
            if (
                $test === false ||
                count($res) != 1
            ) {
                return json_encode(array("Error" => "Account not exist or bad token"));
            }
            $this->augmentDeath($res[0][0]);
            return json_encode($test);
        }
    }

    public function change_password($username, $old_password, $new_password)
    {
        $res = $this->_Account_file->decode_result(
            $this->_Account_file->execute(
                file_get_contents(__DIR__ . "/sql/get_username.sql"),
                [$username]
            )
        );
        if (
            count($res) != 1 ||
            !hash_equals($res[0][2], crypt($old_password, $this->_Salt))
        ) {
            return json_encode(array("Error" => "Account not exist or bad password"));
        }
        $this->_Account_file->execute(
            file_get_contents(__DIR__ . "/sql/changePassword.sql"),
            [crypt($new_password, $this->_Salt), $res[0][0]]
        );
        return json_encode(array(
            "UserName" => $res[0][1],
            "Token" => $res[0][0],
            "A-Token" => $res[0][3]
        ));
    }

    public function getImage($token)
    {
        if (file_exists(__DIR__ . "/img/" . $token . ".png")) {
            $t = "/img/" . $token . ".png";
        } else {
            $t = "/img/null.png";
        }
        return json_encode(base64_encode(file_get_contents(__DIR__ . $t)));
    }

    public function change_img($token, $Atoken, $img)
    {
        if ($this->connectionToken($token, $Atoken) !== false) {
            file_put_contents(__DIR__ . "/img/" . $token . ".png", base64_decode($img));
            return json_encode(array("Ready"));
        }
    }

    public function getName($token)
    {
        $res = $this->_Account_file->decode_result(
            $this->_Account_file->execute(
                file_get_contents(__DIR__ . "/sql/get_Gtoken.sql"),
                [$token]
            )
        );
        if (count($res) != 1) {
            return json_encode(array("Error" => "Token not exist"));
        }
        return json_encode(array("Username" => $res[0][1]));
    }

    public function SearchName($username, $appId)
    {
        $d = array();
        foreach ($this->_Account_file->decode_result(
            $this->_Account_file->execute(
                file_get_contents(__DIR__ . "/sql/searchName.sql"),
                [$appId, "%" . $username . "%"]
            )
        ) as $value) {
            $d[$value[1]] = $value[0];
        }
        return json_encode($d);
    }
}
