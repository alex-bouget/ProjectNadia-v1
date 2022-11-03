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
        include __DIR__ . "/error/error-001.html";
        return;
    }
    $purpose = $_POST["Purpose"];
    $all_purpose = json_decode(file_get_contents(__DIR__ . "/purpose.json"), true);
    if (!in_array($purpose, array_keys($all_purpose))) {
        include __DIR__ . "/error/error-002.html";
        return;
    }
    $purpose_data = $all_purpose[$purpose];
    if (!in_array("Redirect", array_keys($purpose_data))) {
        include __DIR__ . "/error/error-003.html";
        return;
    }
    if (in_array("Require", array_keys($purpose_data))) {
        $i = 0;
        while ($i < count($purpose_data["Require"])) {
            $require = $purpose_data["Require"][$i];
            switch ($require) {
                case "AdminApp":
                    if ($admin_app["AppId"] != $_POST["APPID"]) {
                        include __DIR__ . "/return/NotAdmin.php";
                        return;
                    }
                    break;
                default:
                    break;
            }
            $i++;
        }
    }
    if (true) {
    ?>
        <script>
            formLauncher(
                "POST",
                <?php
                echo "\"" . $purpose_data["Redirect"] . "\",";
                echo "{";
                foreach ($_POST as $key => $value) {
                    if ($key != "Purpose") {
                        echo "'" . $key . "':'" . $value . "',";
                    }
                }
                echo "}";
                ?>
            );
        </script>
    <?php
    }
    ?>
</body>

</html>