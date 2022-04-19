<?php
include_once __DIR__ . "/../private/Admin_app.php";
if (!$admin_app["AppId"] == $_POST["APPID"]) {
    include __DIR__ . "/return/NotAdmin.php";
    die();
}