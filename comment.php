<meta charset="utf-8" />
<?php

    require 'database.php';

    if(isset($_GET['id']) AND !empty($_GET['id'])) {
        $getid = htmlspecialchars($_GET['id']);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $article = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
        $article->execute(array($getid));
        Database::disconnect();
        $article = $article->fetch();

        if(isset($_POST['submit_commentaire'])) {
            if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
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
<h2>Article:</h2>
<p><?= $article['article'] ?></p>
<br />
<h2>Commentaires:</h2>
<form method="POST">
   <input type="text" name="pseudo" placeholder="Votre pseudo" /><br />
   <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
   <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
</form>
<?php if(isset($c_msg)) { echo $c_msg; } ?>
<br /><br />
<?php while($c = $commentaires->fetch()) { ?>
   <b><?= $c['pseudo'] ?>:</b> <?= $c['comment'] ?><br />
<?php } ?>
<?php
}
?>