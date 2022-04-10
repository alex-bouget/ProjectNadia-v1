<?php

include_once __DIR__ . "/private/mysqli_connect.php";
include_once __DIR__ . "/gigly.php";

class MyDB
{
    protected static $isConstruct = false;

    private $connection;
    private $sqlite3;
    private $_sqlite3;

    function execute($query, $array)
    {
        $i = 0;
        while (is_string(stristr($query, "?"))) {
            $query = implode("'" . $array[$i] . "'", explode("?", $query, 2));
            $i++;
        }
        return $this->query($query);
    }

    function decode_result($result)
    {
        $rows = array();
        if ($result) {
            if ($this->sqlite3) {
                while ($row = $result->fetchArray()) {
                    $rows[] = $row;
                }
            } else {
                while ($row = mysqli_fetch_all($result)) {
                    $rows[] = $row;
                }
            }
            if ($this->sqlite3) {
                return $rows;
            }
            return $rows[0];
        } else {
            return false;
        }
    }

    function query(string $query)
    {
        if ($this->sqlite3) {
            return $this->_sqlite3->query($query);
        }
        $t = mysqli_query($this->connection, $query);
        return $t;
    }

    function create_base()
    {
        foreach (scandir(__DIR__ . "/create_database/") as $value) {
            if (!in_array($value, array(".", ".."))) {
                $this->execute(
                    file_get_contents(__DIR__ . "/create_database/" . $value),
                    [
                        crypt(
                            "root",
                            get_properties("AccountSalt")
                        )
                    ] // ADMIN FIRST PASSWORD
                );
            }
        }

        MyDB::$isConstruct = true;

        include_once __DIR__ . "/app/AppApi.php";

        $app = new AppApi();

        $result = json_decode(
            $app->addApp("Nadia", "MainApp for the Api", "AdminFirstRoot1", "kopsriovezvu"),
            true
        );
        file_put_contents(
            __DIR__ . "/private/Admin_app.php",
            "<?php\n\$admin_app = array(\"AppId\" => \""
                . $result["AppId"] . 
                "\", \"Secret_Key\" => \""
                . $result["Secret"] . "\");?>"
        );
    }

    function __construct()
    {
        global $mysqli_account;
        $this->sqlite3 = false;
        if (!$this->sqlite3) {
            $this->connection = mysqli_connect(
                $mysqli_account[0],
                $mysqli_account[1],
                $mysqli_account[2],
                $mysqli_account[3]
            );
            $query = mysqli_query($this->connection, 'select * from Gigly_Right');
            if (!MyDB::$isConstruct && !$query) {
                $this->create_base();
            }
            return;
        }
        if (file_exists(__DIR__ . "/data.db")) {
            $this->_sqlite3 = new SQLite3(__DIR__ . "/data.db");
            return;
        }
        echo json_decode(file_get_contents(__DIR__ . "/client/properties.json"), true)["AccountSalt"];
        $this->_sqlite3 = new SQLite3(__DIR__ . "/data.db");
        $this->create_base();
    }
}
