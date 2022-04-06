<?php include "Site/php/begin.php"; ?>
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
                Account.gigly.getItem("Client.Account", function(err, value) {
                    document.getElementById("username").innerHTML = value["UserName"];
                    Account.rechargeImg("img_info");
                });
            </script>
        </div>
        <div>
            <h1>Changer De mot de passe</h1>
            <br>
            <p>Ancien mot de passe: <input type="password" id="oldPass"></p>
            <p>Nouveau mot de passe: <input type="password" id="newPass"></p>
            <p>Repeter le nouveau mot de passe: <input type="password" id="newPass2"></p>
            <button onclick="Account.changePassw()">Changer le mot de passe</button>
        </div>
        <br>
        <div>
            <h1>Changer l'avatar</h1>
            <br>
            <div>
                <input type="file" id="entry_avatar" accept="image/png, image/jpeg">
                <script>
                    function changeAvatar() {
                        Account.changeImg(document.getElementById("entry_avatar").files[0]);
                        setTimeout(function() {
                            location.href = '?';
                        }, 500);
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
            <button onclick="Account.deco()">Deconnexion</button>
        </div>
    </div>
</div>
<?php include "Site/php/end.php"; ?>