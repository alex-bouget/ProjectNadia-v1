<!DOCTYPE html>
<?php

error_reporting(E_ERROR);
include_once __DIR__ . "/../../../app/AppApi.php";

$api = new AppApi();
?>

<head>
    <title>Nadia-Root</title>
    <script src="../../form_launcher.js"></script>
</head>

<body>
    <?php
    include __DIR__ . "/../../test_token.php";
    include __DIR__ . "/../../test_account.php";
    include __DIR__ . "/../../test_admin.php";
    $appData = json_decode($api->updateApp($_POST["AppViewer"], $_POST["AppName"], $_POST["AppDesc"], $_POST["Token"], $_POST["AToken"]), true);
    ?>
    <script>
        formLauncher(
            "POST",
            "<?php echo urldecode($_POST["URI"]) ?>", {}
        );
    </script>
</body>

</html>