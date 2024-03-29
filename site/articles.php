<?php
require_once '../config/config.php';
require_once '../config/configBdd.php';
require_once 'classes/Bdd.php';
require_once PROJECT_PATH . '/site/functions/functions.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <?php include 'template/_nav.php' ?>
    <?php include 'template/_searchForm.php' ?>

    <form name="select-categorie" action="#" method="post">
      <select class="categorie" name="categorie">
        <?php
        $categories = getCategories();
        foreach ($categories as $categorie): ?>
          <option value="<?= $categorie->id_categorie ?>"><?= $categorie->nom_categorie ?></option>
        <?php endforeach; ?>
      </select>
      <label for="enter"></label>
      <input type="submit" value="Entrée"/>
    </form>
</header>
<hr>
<h1>Articles</h1>
<section>
    <?php
    //recherche
    if(isset($_POST["searchArticle"])){
        $articles = searchArticle($_POST["searchArticle"]);
    } else if(isset($_POST["categorie"])) {
        $articles = getCategory($_POST["categorie"]);
    } else{
        $articles = getArticles();
    }
    //affichage des articles
    foreach ($articles as $article){
        include 'template/_article_preview.php';
    }
    ?>
</section>
</body>
</html>
