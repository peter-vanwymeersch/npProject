<?php
session_start();

$err_connect="";
$err_connexion="";

require 'database.php';

// Registration
if(isset($_POST['submit_registration'])) {
    echo "php 2";
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $pswd = sha1($_POST['pswd']);
   $pswd2 = sha1($_POST['pswd2']);
   $status = htmlspecialchars($_POST['status']);
   
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['pswd']) AND !empty($_POST['pswd2'])) {
        $pseudolength = strlen($pseudo);
        if($pseudolength <= 255) {
            if($mail == $mail2) {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $reqmail = $pdo->prepare("SELECT * FROM member WHERE mail = ?");
                $reqmail->execute(array($mail));
                Database::disconnect();
                $mailexist = $reqmail->rowCount();
                if($mailexist == 0) {
                    if($pswd == $pswd2) {
                        $pdo = Database::connect();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $insertmbr = $pdo->prepare("INSERT INTO member(pseudo, member_status, mail, member_pswd) VALUES(?, ?, ?, ?)");
                        $insertmbr->execute(array($pseudo, $status, $mail, $pswd));
                        Database::disconnect();
                        $err_registration = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                    } else {
                        $err_registration = "Vos mots de passes ne correspondent pas !";
                    }
                } else {
                    $err_registration = "Adresse mail déjà utilisée !";
                }
                } else {
                $err_registration = "Votre adresse mail n'est pas valide !";
                }
            } else {
                $err_registration = "Vos adresses mail ne correspondent pas !";
            }
        } else {
            $err_registration = "Votre pseudo ne doit pas dépasser 255 caractères !";
        }
    } else {
        $err_registration = "Tous les champs doivent être complétés !";
    }
}

// Connexion
if(isset($_POST['submit_connexion'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $pswdconnect = sha1($_POST['pswdconnect']);
 
    if(!empty($mailconnect) AND !empty($pswdconnect)) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $requser = $pdo->prepare("SELECT * FROM member WHERE mail = ? AND member_pswd = ?");
        $requser->execute(array($mailconnect, $pswdconnect));
        Database::disconnect();
        $userexist = $requser->rowCount();
        echo ($userexist);
        if($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['member_status'] = $userinfo['member_status'];
            $_SESSION['mail'] = $userinfo['mail'];
            if ($userinfo['member_status'] == 2) {
                header("Location: commentMbrA.php?id=1");
            } else {
                header("Location: commentMbr.php?id=1");
            }
        } else {
            $err_connect = "Mauvais mail ou mot de passe !";
        }
    } else {
        $err_connect = "Tous les champs doivent être complétés !";
    }
 }

// Deconnexion
if(isset($_POST['deconnexion'])) {
//print_r ($_SESSION);
unset($_SESSION['id']);
unset($_SESSION['pseudo']);
unset($_SESSION['member_status']);
unset($_SESSION['mail']);
// print_r ($_SESSION);
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
        <title>npProject - Espace membre</title>
    </head>
    <body>
        <?php require "header.php" ?>
        
        <div class="container-fluid" id="mainContainer">
            <h1 id="pageTitel">Espace membres</h1>
            <div class="d-flex justify-content-around" >

                <!-- Registration form -->

                <div class="col-6" style="border: 1px solid black;">
                    <form method="POST"  action="" role="form" class="form-horizontal">
                       <fieldset>

                            <!-- Form Name -->
                            <legend>Inscription</legend>

                            <!-- Text input-->
                            <div class="form-group row">
                                <label class="col-md-4 control-label" for="pseudo">Pseudo</label>  
                                <div class="col-md-4">
                                    <input id="pseudo" name="pseudo" type="text" placeholder="Entrez votre pseudo" class="form-control input-md">
                                    <!--<span class="help-block">help</span>--> 
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group row">
                                <label class="col-md-4 control-label" for="mail">Email</label>  
                                <div class="col-md-4">
                                    <input id="mail" name="mail" type="text" placeholder="Entrez votre adresse email" class="form-control input-md">
                                    <!--<span class="help-block">help</span>-->  
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group row">
                                <label class="col-md-4 control-label" for="mail2">Email (confirmation)</label>  
                                <div class="col-md-4">
                                    <input id="mail2" name="mail2" type="text" placeholder="Entrez votre adresse email" class="form-control input-md">
                                    <!--<span class="help-block">help</span>-->  
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group row">
                                <label class="col-md-4 control-label" for="pswd">Mot de passe</label>
                                <div class="col-md-4">
                                    <input id="pswd" name="pswd" type="password" placeholder="Entrez votre mot de passe" class="form-control input-md">
                                    <!--<span class="help-block">help</span>-->
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group row">
                                <label class="col-md-4 control-label" for="pswd2">Mot de passe (confirmation)</label>
                                <div class="col-md-4">
                                    <input id="pswd2" name="pswd2" type="password" placeholder="Entrez votre mot de passe" class="form-control input-md">
                                    <!--<span class="help-block">help</span>-->
                                </div>
                            </div>

                            <!-- Multiple Radios -->
                            <div class="form-group row">
                                <label class="col-md-4 control-label" for="radios">Status</label>
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label for="status1">
                                            <input type="radio" name="status" id="status1" value="1" checked="checked">
                                            Membre
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="status2">
                                            <input type="radio" name="status" id="status2" value="2">
                                            Membre actif
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit_registration">Je m'inscris</button>
                            <button type="reset" class="btn btn-secondary">J'efface</button>
                        </fieldset>
                        <br>
                        <?php if(isset($err_registration)) { echo $err_registration; } ?>
                    </form>
                </div>

                <!-- Connexion form -->

                <div class="col-6" style="border: 1px solid black;">
                    <form method="POST"  action="" role="form" class="form-horizontal">
                       <fieldset>

                            <!-- Form Name -->
                            <legend>Connexion</legend>

                            <!-- Text input-->
                            <div class="form-group row">
                                <label class="col-md-4 control-label" for="mailconnect">Email</label>  
                                <div class="col-md-4">
                                    <input id="mailconnect" name="mailconnect" type="text" placeholder="Entrez votre adresse email" class="form-control input-md">
                                    <!--<span class="help-block">help</span>-->  
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group row">
                                <label class="col-md-4 control-label" for="pswdconnect">Mot de passe</label>
                                <div class="col-md-4">
                                    <input id="pswdconnect" name="pswdconnect" type="password" placeholder="Entrez votre mot de passe" class="form-control input-md">
                                    <!--<span class="help-block">help</span>-->
                                </div>
                            </div>

                           
                            <button type="submit" class="btn btn-primary" name="submit_connexion">Je me connecte</button>
                            <button type="reset" class="btn btn-secondary">J'efface</button>
                            <button type="submit" class="btn btn-info" name="deconnexion">Je me déconnecte</button>
                        </fieldset>
                        <br>
                        <?php //if(isset($err_connect)) { echo $err_connect; } 
                            //var_dump($_SESSION);?>
                        
                    </form>
                </div>
            </div>
        </div>
        <?php require "footer.php" ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <sc ript src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
        