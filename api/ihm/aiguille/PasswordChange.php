<?php
$app = new AppApi();
if ($admin_app["AppId"] == $_POST["APPID"]) {
        include __DIR__ . "/PasswordChange/LaunchChange.php";
} else { 
    include __DIR__ . "/PasswordChange/NotAdmin.php";
}