<?php
session_start();

$bdd = new PDO('mysql: host=localhost; dbname=member_area', 'root', '');

if(isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM member WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $bdd->prepare("UPDATE member SET pseudo = ? WHERE id = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
        header('Location: profile.php?id='.$_SESSION['id']);
    }

    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $bdd->prepare("UPDATE member SET mail = ? WHERE id = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        header('Location: profile.php?id='.$_SESSION['id']);
    }

    if(isset($_POST['newpswd1']) AND !empty($_POST['newpswd1']) AND isset($_POST['newpswd2']) AND !empty($_POST['newpswd2'])) {
        $mdp1 = sha1($_POST['newpswd1']);
        $mdp2 = sha1($_POST['newpswd2']);
        if($mdp1 == $mdp2) {
            $insertmdp = $bdd->prepare("UPDATE member SET member_pswd = ? WHERE id = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            header('Location: profile.php?id='.$_SESSION['id']);
        } else {
            $msg = "Vos deux mots de passe ne correspondent pas !";
    }
}
?>
    <!doctype html>
    <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="public/css/style.css">
            <title>npProject</title>
        </head>
        <body>
            <?php require "header.php" ?>
            <div class="container" id="mainContainer">
                <section class="d-flex justify-content-center">
                    <div class="p-4">
                        <h1 id="pageTitel">Edition de mon profil</h1>  
                        <div align="center">
                            <div align="left">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <label>Pseudo :</label>
                                    <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
                                    <label>Mail :</label>
                                    <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br /><br />
                                    <label>Mot de passe :</label>
                                    <input type="password" name="newpswd1" placeholder="Mot de passe"/><br /><br />
                                    <label>Confirmation - mot de passe :</label>
                                    <input type="password" name="newpswd2" placeholder="Confirmation du mot de passe" /><br /><br />
                                    <input type="submit" value="Mettre à jour mon profil !" />
                                </form>
                                <?php if(isset($msg)) { echo $msg; } ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php require "footer.php" ?>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </body>
    </html>
<?php
}
else {
    header("Location: connexion.php");
}
?>