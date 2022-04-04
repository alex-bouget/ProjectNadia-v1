<?php

include "AccountAPI.php";

$api = new AccountAPI();

function create_account() {
    global $api;
    return $api->create_account($_POST["Username"], $_POST["Password"]);//, $_POST["mail-address"]);
}

function autoconnect() {
    global $api;
    return $api->connect_account($_POST["Username"], $_POST["A-Token"], "Token");
}

function connect() {
    global $api;
    return $api->connect_account($_POST["Username"], $_POST["Password"], "Password");
}

function change_pass() {
    global $api;
    return $api->change_password($_POST["Username"], $_POST["old_password"], $_POST["new_password"]);
}

function Get_image() {
    global $api;
    return $api->getImage($_POST["Token"]);
}

function ChangeImage()
{
    global $api;
    return $api->change_img($_POST["Token"], $_POST["A-Token"], $_POST["Img"]);
}

function Get_name() {
    global $api;
    return $api->GetName($_POST["Token"]);
}

function Search_name() {
    global $api;
    return $api->SearchName($_POST["Username"]);
}

?>