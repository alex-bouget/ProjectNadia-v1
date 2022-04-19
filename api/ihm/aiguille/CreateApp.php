<?php
$app = new AppApi();
if ($admin_app["AppId"] == $_POST["APPID"]) {
        include __DIR__ . "/return/createApp.php";
} else { 
    include __DIR__ . "/return/NotAdmin.php";
}