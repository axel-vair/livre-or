<?php
include 'connect.php';
include 'header.php';
/*
 #1 - We stock our request inside a variable.
    We select date, commentaire from table commentaire and login from table utilisateurs.
    We join the two tables with the id_utilisateur from table commentaire and id from table utilisateurs.
    We order the results by date DESC.
 #2 - We prepare the request.
 #3 - We execute the request.
 #4 - We fetch the result and we specify we wanna fetch data inside FETCH_ASSOC.
*/
$sql = $conn->prepare("SELECT commentaires.date, utilisateurs.login, commentaires.commentaire, commentaires.id 
                                 FROM utilisateurs 
                                 INNER JOIN commentaires 
                                 ON utilisateurs.id = commentaires.id_utilisateur 
                                 ORDER BY commentaires.id DESC");
$sql->execute();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['delete'])){
    $delete = "DELETE FROM commentaires WHERE commentaires.id = $_POST[delete]";
    $sql_delete = $conn->prepare($delete);
    $sql_delete->execute();
    header('Location: livre-or.php');
}


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="or-style.css">
    <title>Livre d'or</title>
</head>
<body>
<section class="container_formulaire">
    <h1>Livre d'or</h1>



    <div class="container_livre">

        <?php
        foreach ($results as $row){
            echo "<div class='result'>";
            echo "<div id='info'>";
            echo "Posté le " . $row["date"] . "." . " Par " . $row["login"];
            echo "</div>";
            echo "<div id='com'>";
            echo "<br>" . $row['commentaire'];
            echo "</div>";
            if(@$_SESSION['login'] == $row['login']){
                echo "<form method='POST'><button type='submit' name='delete' value=".$row['id'].">Supprimer</button></form>"; // Mehdi Romdhani - Thank you !
            }
            echo "</div>";
        }
        ?>
        <?php if(empty($_SESSION['login'])){
            echo "<p>Connectez-vous pour laisser un commentaire</p>";
        }else{
            echo "<div id='butt'>";
            echo "<a href='commentaire.php'><button class='modifier' id='button_com' type='submit' name='submit'>Écrire un commentaire</button></a>";
            echo "</div>";
        }
        ?>
    </div>

</section>
<?php include 'footer2.php'?>
</body>
</html>