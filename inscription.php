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
    <div class="container" id="homepage">
      <section class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h1>Inscription</h1>
          <!--<form method="post" action="logSys/create.php" class="d-flex flex-column ml-3" oninput='password2.setCustomValidity(password2.value != password.value ? "Passwords do not match." : "")'>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="user" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="">Confirm password</label>
                                <input type="password" name="password2"class="form-control" placeholder="" required>
                            </div>
                            <button type="submit" name="create" class="btn btn-film mt-3">Create account</button>
                            &nbsp;
                        </form>-->
            <form method="post" action="" class="" oninput='memberPassword2.setCustomValidity (memberPassword2.value != memberPassword.value ? ""Mot de passe différent! : "")'>
                <div class="form-group">
                    <label for="memberEmail">Adresse email</label>
                    <input type="email" class="form-control" id="memberEmail" aria-describedby="emailHelp" placeholder="Entrer votre adresse email" required>
                </div>
                <div class="form-group">
                    <label for="memberPassword1">Mot de passe</label>
                    <input type="password" class="form-control" name="memberPassword1" id="memberPassword1" placeholder="Mot de passe" required>
                </div>
                <div class="form-group">
                    <label for="memberPassword2">Retapez votre mot de passe</label>
                    <input type="password" class="form-control" name="memberPassword2" id="memberPassword1" placeholder="Mot de passe" required>
                </div> 
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Membre
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                                Membre actif
                            </label>
                        </div>
                    </div>
                    </div>
                </fieldset>               
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
        <div class="col-lg-3"></div>
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