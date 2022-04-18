<?php
//GET: APPID, tempToken, URI

include_once __DIR__ . "/../app/AppApi.php";

$app = new AppApi();


// Lock if not have parameters
if (!isset($_GET["APPID"]) || !isset($_GET["tempToken"]) || !isset($_GET["URI"])) {
    echo "Missing arguments";
    die(1);
}

$tokenGood = isset(json_decode($app->testTempToken($_GET["APPID"], $_GET["tempToken"]), true)["Error"]);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nadia-Connection</title>
    <script src="modules/XMLsync.js"></script>
    <script src="modules/RCJS_API.js"></script>
    <script src="modules/Nadia.js"></script>
    <script src="modules/localforage.js"></script>
    <script src="form_launcher.js"></script>
    <script>
        function removeURLParameter(url, parameter) {
            //prefer to use l.search if you have a location/link object
            var urlparts = url.split('?');
            if (urlparts.length >= 2) {

                var prefix = encodeURIComponent(parameter) + '=';
                var pars = urlparts[1].split(/[&;]/g);

                //reverse iteration as may be destructive
                for (var i = pars.length; i-- > 0;) {
                    //idiom for string.startsWith
                    if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                        pars.splice(i, 1);
                    }
                }

                return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
            }
            return url;
        }

        var nadia = localforage.createInstance({
            name: "Nadia"
        });
        nadia.getItem("Client.Account", function(err, value) {
            if (value != undefined) {
                var data = PcJsApi_Nadia.AutoConnectAccount(
                    "bLHrlEtuDaz0mG2I3AZvxweyP",
                    value["UserName"],
                    value["A-Token"]);
                if (!Object.keys(data).includes("Error")) {
                    formLauncher(
                        "POST",
                        "app_connection.php", {
                            "APPID": <?php echo json_encode($_GET["APPID"]); ?>,
                            "tempToken": <?php echo json_encode($_GET["tempToken"]); ?>,
                            "URI": <?php echo json_encode($_GET["URI"]); ?>,
                            "alreadyConnected": "true",
                            "user": result["UserName"],
                            "pass": result["A-Token"]
                        }
                    )
                }
            }
        });
    </script>
</head>

<body>
    <?php if ($tokenGood) { ?>
        <script>
            formLauncher(
                "POST",
                "<?php echo urldecode($_GET["URI"]) ?>", {
                    "Error": "tempToken not valid"
                }
            );
        </script>

    <?php } else { ?>
        <div>
            <div class="partie">
                <?php
                if (isset($_GET["Error"])) {
                    echo "<h1>Erreur: " . urldecode($_GET["Error"]) . "</h1>";
                    // Show Possible Error
                }
                ?>
                <form method="POST" action="connection_exit.php">
                    <input type="hidden" value=<?php echo "${_GET["APPID"]}"; ?> name="APPID">
                    <input type="hidden" value=<?php echo "${_GET["tempToken"]}"; ?> name="tempToken">
                    <input type="hidden" value=<?php echo "${_GET["URI"]}"; ?> name="URI">
                    <input type="hidden" value="false" name="alreadyConnected">
                    <!-- Input always here  -->

                    <?php if (isset($_GET["create"])) { ?>
                        <h1>CREER UN COMPTE</h1>
                        <input type="hidden" value="create" id="type" name="type">
                    <?php } else { ?>
                        <h1>CONNEXION A UN COMPTES</h1>
                        <input type="hidden" value="connect" id="type" name="type">
                    <?php }
                    // If create is set, we switch in create account.
                    ?>

                    <br>
                    <p>Nom d'utilisateur: <input type="text" id="user" name="user"></p>
                    <p>Mot de passe: <input type="password" id="pass" name="pass"></p>

                    <?php if (isset($_GET["create"])) { ?>
                        <p>Répéter le mot de passe: <input type="password" id="pass2" name="pass2"></p>
                        <!-- If create is set, we ask for a password confirmation. -->
                    <?php } ?>

                    <input type="submit" value=<?php
                                                echo isset($_GET["create"]) ?
                                                    "Creer le compte" :
                                                    "Connexion";
                                                ?>>
                </form>
                <?php if (isset($_GET["create"])) { ?>
                    <button onclick="location.href  = removeURLParameter(location.href, 'create')">
                        Connexion a un compte</button>
                <?php } else { ?>
                    <button onclick="location.href  += '&create=true'">Creer un compte</button>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</body>

</html>