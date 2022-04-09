<?php

include __DIR__ . "/client/AccountAPI.php";
include __DIR__ . "/app/AppApi.php";

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
