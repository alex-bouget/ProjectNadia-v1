<?php

/*
 * PCJs_API 1.0
 * by MisterMine01
 * GET cursor to function
 */
//header("Content-Type: application/json");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Access-Control-Allow-Origin: null");
$RCJS = "ReturnSystem.json";
$function_included = array(
    __DIR__ . "../database.php",
    __DIR__ . "../gigly.php",
    __DIR__ . "AccountSystem.php",
    __DIR__ . "client.php"
);

error_reporting(E_ERROR);
foreach ($function_included as $value) {
    include_once $value;
}
if (isset($_GET["MM1_jc"])) { // Launch function
    if ($_GET["MM1_jc"] == "200") {
        echo file_get_contents($RCJS);
    }
}

$DATA = json_decode(file_get_contents($RCJS), true); // Get System

foreach ($DATA as $key => $value) {
    $test = 0;
    foreach ($value["GET"] as $key0 => $value0) {
        if (isset($_GET[$key0])) {
            if ($_GET[$key0] == $value0) {
                $test = $test + 1;
            }
        }
    }
    if ($test == count($value["GET"])) {
        $test2 = 0;
        foreach ($value["POST"] as $key0) {
            if (isset($_POST[$key0])) {
                $test2 = $test2 + 1;
            }
        }
        if ($test2 == count($value["POST"])) {
            echo $value["PHP_function"](); // Call function
        }
    }
}
