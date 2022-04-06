<?php include "Site/php/begin.php"; ?>
<div>
    <div class="partie">
        <?php if (isset($_GET["create"])) { ?>
            <h1>CREER UN COMPTE</h1>
            <input type="hidden" value="create" id="type">
        <?php } else { ?>
            <h1>CONNEXION A UN COMPTES</h1>
            <input type="hidden" value="connect" id="type">
        <?php } ?>
        <br>
        <p>Nom d'utilisateur: <input type="text" id="user"></p>
        <p>Mot de passe: <input type="password" id="pass"></p>
        
        <?php if (isset($_GET["create"])) { ?>
        <p>Répéter le mot de passe: <input type="password" id="pass2"></p>
        <?php } ?>

        <button onclick="Account.createButton()"><?php if (!isset($_GET["create"])) {echo "Connexion";} else {echo "Creer le compte";} ?></button>
        <?php if (isset($_GET["create"])) { ?>
        <button onclick="location.href  = '?'">Connexion a un compte</button>
        <?php } else { ?>
        <button onclick="location.href  = '?create=true'">Creer un compte</button>
        <?php } ?>
    </div>
</div>
<?php include "Site/php/end.php"; ?>