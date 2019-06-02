<?php
/**
 * @param $id
 * @return mixed
 */
function getArticle($id){
    $pdo = Bdd::getPdo();
    $req = $pdo->prepare("SELECT * FROM article WHERE id_article=?");//prepare impératif !!!!
    $req->execute([$id]);
    $article = $req->fetchObject();
    return $article;
}

/**
 * @return array
 */
function getArticles(){
    $pdo = Bdd::getPdo();
    $req = $pdo->query("SELECT * FROM article JOIN categorie c ON article.id_categorie = c.id_categorie ORDER BY date_article DESC");//ici on peut utiliser query car il n'y a pas de données externes dans la requête
    $articles = $req->fetchAll(PDO::FETCH_OBJ);
    return $articles;
}

/**
 * @param $str
 * @return array
 */
function searchArticle($str){
    $pdo = Bdd::getPdo();
    $search = "%$str%";
    $req = $pdo->prepare("SELECT * FROM article WHERE titre_article LIKE ?");//prepare impératif !!!!
    $req->execute([$search]);
    $articles = $req->fetchAll(PDO::FETCH_OBJ);
    return $articles;
}

function getCategories(){
  $pdo = Bdd::getPdo();
  $req = $pdo->query("SELECT * FROM categorie WHERE id_categorie");
  $categories = $req->fetchAll(PDO::FETCH_OBJ);
  return $categories;
}
/**
 * @param $nom
 * @return mixed
 */
function getCategory($nom){
  $pdo = Bdd::getPdo();
  $req = $pdo->prepare("SELECT * FROM article JOIN categorie ON article.id_categorie = categorie.id_categorie WHERE article.id_categorie = ?");
  $req->execute([$nom]);
  $articles = $req->fetchAll(PDO::FETCH_OBJ);
  return $articles;
}
