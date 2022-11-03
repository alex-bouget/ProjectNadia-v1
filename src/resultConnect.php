<!DOCTYPE html>

<html>

<head>
    <title>Nadia</title>
    <script src="site/js/modules/localforage.js"></script>
    <script src="site/js/form_launcher.js"></script>
</head>

<body>
    <?php
    if (in_array("Error", array_keys($_POST))) {
        echo "<script>location.href = \"index.php\"; </script>";
    } else { ?>
        <script>
            var nadia = localforage.createInstance({
                name: "Nadia"
            });
            nadia.setItem("Client.Account", JSON.parse('<?php echo json_encode($_POST); ?>')).then(function() {
                formLauncher(
                    "GET", "index.php", {}
                );
            });
        </script>
    <?php } ?>

</body>

</html>