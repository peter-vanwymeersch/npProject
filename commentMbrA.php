<?php
    session_start();

    require 'database.php';

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $articles = $pdo->prepare('SELECT id, date_article, article FROM articles ORDER BY date_article DESC');
    $articles->execute();
    Database::disconnect();

    if(isset($_GET['id']) AND !empty($_GET['id'])) {
        $getid = htmlspecialchars($_GET['id']);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $article = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
        $article->execute(array($getid));
        Database::disconnect();
        $article = $article->fetch();

        if(isset($_POST['submit_commentaire'])) {
            //if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {
                //$pseudo = htmlspecialchars($_POST['pseudo']);
            if(isset($_POST['commentaire']) AND !empty($_POST['commentaire'])) {    
                $pseudo = $_SESSION['pseudo'];
                $commentaire = htmlspecialchars($_POST['commentaire']);
                if(strlen($pseudo) < 255) {
                    $pdo = Database::connect();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $ins = $pdo->prepare('INSERT INTO comments (pseudo, comment, id_article) VALUES (?,?,?)');
                    $ins->execute(array($pseudo,$commentaire,$getid));
                    Database::disconnect();
                    $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";
                } else {
                    $c_msg = "Erreur: Le pseudo doit faire moins de 25 caractères";
                }
            } else {
                $c_msg = "Erreur: Tous les champs doivent être complétés";
            }
    }
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $commentaires = $pdo->prepare('SELECT * FROM comments WHERE id_article = ? ORDER BY id DESC');
    $commentaires->execute(array($getid));
    Database::disconnect();
    
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
        <div class="container-fluid" id="mainContainer">
            <h1 id="pageTitel" class="">Espace Articles et Commentaires</h1>
            <div class="d-flex justify-content-around" >

                <!-- Articles list -->
                <div class="col-6" style="border: 1px solid black;">
                        <?php 
                            foreach ($articles as $art) { ?>
                                
                                <?php echo '<a href="commentMbrA.php?id='.$art['id'].'" class="cjp-article"><b>'.$art['date_article'].'</b><br>'.$art['article'].'<br></a>'; ?>
                                
                        <?php } ?>
                </div>
            
                <!-- Comment area -->

                <div class="col-6" style="border: 1px solid black;">
                    <h2>Article:</h2>
                    <p><?= $article['article'] ?></p>
                    <br />
                    <h2>Commentaires:</h2>
                    <form method="POST">
                        <!--<input type="text" name="pseudo" placeholder="Votre pseudo" /><br />-->
                        <input type="text" name="pseudo" placeholder=<?= $_SESSION['pseudo'] ?> disabled/><br />
                        <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
                        <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
                    </form>
                    <?php if(isset($c_msg)) { echo $c_msg; } ?>
                    <br /><br />
                    <?php while($c = $commentaires->fetch()) { ?>
                        <b><?= $c['pseudo'] ?>:</b> <?= $c['comment'] ?><br />
                    <?php } ?>
                    <?php } ?>
                </div>

            </div>
        </div>
    

    <?php require "footer.php" ?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>