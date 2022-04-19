<!DOCTYPE html>
<html>

<head>
    <title>Nadia-IHM-Entry</title>
    <script src="form_launcher.js"></script>
</head>

<body>
    <?php
    if (!isset($_GET["Purpose"])) { ?>
        <h1>Error N-001</h1>
        <br>
        <p>Contact an administrator from the entry point</p>
        <?php
        die();
    } else {
        switch ($_GET["Purpose"]) {
            case "Connection":
        ?>
                <script>
                    formLauncher(
                        "GET",
                        "connection/", {
                            <?php
                            foreach ($_GET as $key => $value) {
                                if ($key != "Purpose") {
                                    echo "'" . $key . "':'" . $value . "',";
                                }
                            }
                            ?>
                        }
                    );
                </script>
            <?php
                break;
            case "PasswordChange":
            ?>
                <h1>Error N-003</h1>
                <br>
                <p>This part is not implemented</p>
                <p>Return to this later</p>
            <?php
                die();
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