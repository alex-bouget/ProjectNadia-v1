<?php
include_once __DIR__ . "/../private/Admin_app.php";
include_once __DIR__ . "/../app/AppApi.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nadia-IHM-Entry</title>
    <script src="form_launcher.js"></script>
</head>

<body>
    <?php
    include __DIR__ . "/test_token.php";
    if (!isset($_POST["Purpose"])) { ?>
        <h1>Error N-001</h1>
        <br>
        <p>Contact an administrator from the entry point</p>
        <?php
        die();
    } else {
        switch ($_POST["Purpose"]) {
            case "Connection":
        ?>
                <script>
                    formLauncher(
                        "POST",
                        "connection/",
                        <?php
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
                break;
            case "PasswordChange":
                $app = new AppApi();
                if ($admin_app["AppId"] == $_POST["APPID"]) {
                    if (!in_array("Error", array_keys(
                        json_decode(
                            $app->testTempToken(
                                $_POST["APPID"],
                                $_POST["tempToken"]
                            ),
                            true
                        )
                    ))) {
                ?>
                        <!-- LAUNCH Password Change -->
                        <script>
                            formLauncher(
                                "POST",
                                "changePasswd/",
                                <?php
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
                    <?php } else { ?>
                        <!-- LAUNCH tempToken ERROR -->
                        <script>
                            formLauncher(
                                "POST",
                                "<?php echo urldecode($_POST["URI"]) ?>", {
                                    "Error": "tempToken not valid"
                                }
                            );
                        </script>
                    <?php }
                } else { ?>
                    <!-- LAUNCH Admin App lock -->
                    <script>
                        formLauncher(
                            "POST",
                            "<?php echo urldecode($_POST["URI"]) ?>", {
                                "Error": "App not have the right"
                            }
                        );
                    </script>
                <?php }
                break;
            case "PasswordReset":
                ?>
                <h1>Error N-003</h1>
                <br>
                <p>This part is not implemented</p>
                <p>Return to this later</p>
            <?php
                die();
            default:
            ?>
                <h1>Error N-002</h1>
                <br>
                <p>Contact an administrator from the entry point</p>
    <?php
                die();
        }
    }
    ?>
</body>

</html>