<?php
include_once __DIR__ . "/../../private/Admin_app.php";
include_once __DIR__ . "/../../app/AppApi.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nadia-IHM-Entry</title>
    <script src="../form_launcher.js"></script>
</head>

<body>
    <?php
    include __DIR__ . "/../test_token.php";
    if (!isset($_POST["Purpose"])) {
        include __DIR__ . "error-001.html";
    } else {
        switch ($_POST["Purpose"]) {
            case "Connection":
                include "return/Connection.php";
                break;
            case "PasswordChange":
                include "PasswordChange.php";
                break;
            case "AllMyApp":
                include "error-003.html";
                break;
            case "CreateApp":
                include "CreateApp.php";
                break;
            case "PasswordReset":
                include "error-003.html";
                break;
            default:
                include "error-002.html";
                break;
        }
    }
    ?>
</body>

</html>