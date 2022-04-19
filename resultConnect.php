<!DOCTYPE html>

<html>

<head>
    <title>Nadia</title>
    <script src="Site/js/modules/localforage.js"></script>
    <script src="Site/js/form_launcher.js"></script>
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