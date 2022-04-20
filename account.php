<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="Site/css/norm.css">
    <link rel="stylesheet" href="Site/css/header.css">
    <script src="Site/js/modules/localforage.js"></script>
    <script src="Site/js/modules/RCJS_API.js"></script>
    <script src="Site/js/modules/XMLsync.js"></script>
    <script src="Site/js/form_launcher.js"></script>
    <script src="Site/js/Nadia.js"></script>
    <script src="Site/js/site.js"></script>
    <title>Nadia-Web</title>
</head>

<body>
    <header>
        <img src="Site/img/gigly.png" alt="icone">
        <div id="navig">
            <nav>
                <?php
                foreach (json_decode(file_get_contents(__DIR__ . "/header.json"), true) as $key => $value) {
                    echo "<p><a href=\"" . $value . "\">" . $key . "</a></p>";
                }
                ?>
            </nav>
        </div>
        <div class="circular" id="avatar_div">
            <img id="avatar_img" alt="se connecter" src="Site/img/connect.jpg">
            <div id="listA">
                <p><a href="account.php">Info</a></p>
                <p><a href="createApp.php">Create App</a></p>
            </div>
        </div>
    </header>
    <div>
        <div class="partie">
            <style>
                #img_info {
                    width: 400px;
                    height: 400px;
                }
            </style>
            <div>
                <h1> Information </h1>
                <br>
                <p>Nom utilisateur: <span id="username"></span><br></p>
                <img src="img/connect.jpg" id="img_info">
                <script>
                    NadiaSite.nadia.getItem("Client.Account", function(err, value) {
                        document.getElementById("username").innerHTML = value["UserName"];
                        setTimeout(function() {
                            NadiaSite.rechargeImg("img_info");
                        }, 500);
                    });
                </script>
            </div>
            <div>
                <button onclick="NadiaSite.changePasswd()">Changer De mot de passe</button>
            </div>
            <br>
            <div>
                <h1>Changer l'avatar</h1>
                <br>
                <div>
                    <input type="file" id="entry_avatar" accept="image/png, image/jpeg">
                    <script>
                        function changeAvatar() {
                            NadiaSite.changeImg(document.getElementById("entry_avatar").files[0]);
                        }
                    </script>
                    <button onclick='changeAvatar()'>
                        Changer l'avatar</button>
                </div>
            </div>
            <br>
            <div>
                <h1>Autre</h1>
                <br>
                <button onclick="NadiaSite.deco()">Deconnexion</button>
            </div>
        </div>
    </div>
</body>

</html>