    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!--<link rel="stylesheet" type="text/css" href="public/css/style.css">-->
        <title>Template page</title>
    </head>
    <body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        <!-- Brand, toggle pour l'affichage en version mobile -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Brand</a>
        </div>
        <!-- Liens de navigation, formulaires et autres -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
        <li class="active"><a href="#" title="Lien actif">Lien actif <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Lien 2 <span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="#" title="Lien 2.1">Lien 2.1</a></li>
        <li><a href="#" title="Lien 2.2">Lien 2.2</a></li>
        <li><a href="#" title="Lien 2.3">Lien 2.3</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#" title="Lien séparé 1">Lien séparé 1</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#" title="Lien séparé 2">Lien séparé 2</a></li>
        </ul>
        </li>
        </ul>
        <form class="navbar-form navbar-left">
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Rechercher">
        </div>
        <button type="submit" class="btn btn-sm btn-default">OK</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="#" title="Lien à droite">Lien à droite</a></li>
        </ul>
        </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav> 
        Content
        <?php require "header.html" ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>