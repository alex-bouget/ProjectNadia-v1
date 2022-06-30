<?php

include_once __DIR__ . "/client/AccountAPI.php";
include_once __DIR__ . "/app/AppApi.php";

$account = new AccountAPI();
$app = new AppApi();

function GetImage()
{
    global $account;
    return $account->getImage($_POST["Token"]);
}

function GetTempToken()
{
    global $app;
    return $app->getTempToken(
        $_POST["appKey"],
        $_POST["appSecret"]
    );
}

function AutoConnectAccountUsername()
{
    global $app;
    return $app->AutoConnectAccountUsername(
        $_POST["AppId"],
        $_POST["Username"],
        $_POST["A-Token"]
    );
}

function AutoConnectAccount()
{
    global $app;
    return $app->AutoConnectAccount(
        $_POST["AppId"],
        $_POST["Token"],
        $_POST["A-Token"]
    );
}

function GetName() {
    global $account;
    return $account->GetName($_POST["Token"]);
}

function SearchByName()
{
    global $account;
    return $account->SearchName($_POST["Username"], $_POST["AppId"]);
}