<?php
include 'header.php'; // HEADER FILE LINK
include 'connect.php'; // CONNECT FILE LINK

// If global variable session login is empty redirect to index.php
if(empty($_SESSION['login'])){
    header("Location: inscription.php");
}
/*
   #1 - If the user is connected, we display the form to add a comment.
   #2 - Login is equal to the session login.
   #3 - We stock the request inside a variable. The resquest select id and
   login from the table utilisateurs where login is equal to the session login.
   #4 - We prepare the request.
   #5 - We execute the request.
   #6 - We fetch the result and we specify we wanna fetch data inside FETCH_ASSOC.
*/
if(isset($_SESSION)) {
    $login = $_SESSION['login'];
    $sql = "SELECT id, login FROM utilisateurs WHERE login = :login";
    $sql_exe = $conn->prepare($sql);
    $sql_exe->bindParam(':login', $login);
    $sql_exe->execute();
    $results = $sql_exe->fetch(PDO::FETCH_ASSOC);
    $idUser = $results['id']; // We stock the id inside a variable
    $date = getdate(); // We stock the date inside a variable
    $date = $date['year'].'-'.$date['mon'].'-'.$date['mday'];

    /*
        #1 - If post message is not empty and if submit button is clicked we stock
        the message inside a variable.
        #2 - We insert the message,the id of the user and the date inside the table commentaire.
        #3 - The marker :commentaire is binded to the variable $commentaire. The marker :id_user
        is binded to the variable $idUser. The marker :date is binded to the variable $date.
        #4 - We execute the request inside array.
        #5 - We redirect to index.php
    */
       if(empty($_POST['message']) && isset($_POST['submit'])) {
        echo "<p id='error'>Veuillez remplir le champ commentaire</p>";
         }if(!empty($_POST['message'])){
            $commentaire = $_POST['message'];
            $sql = 'INSERT INTO commentaires(commentaire, id_utilisateur, date) VALUES(:commentaire, :id_utilisateur, :date)';
            $sql_insert = $conn->prepare($sql);
            $sql_insert->execute(([$commentaire, $idUser, $date]));
            header('Location: livre-or2.php');
        }
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
    <title>Commentaire</title>
</head>
<body>
<section class="container_formulaire">
    <h1> Écrire un commentaire </h1>
    <section id="formulaire">
        <form action="" method="post" id="commentaire">
            <fieldset id="fieldset_comment">

                <label><p id="p_commentaire"><?php echo 'Vous écrivez votre message en tant que : ' . $_SESSION['login'];?> </p> </label> <br>
                <textarea name="message" form="commentaire" rows="13" cols="33" placeholder="entrez votre message"></textarea>
                <button type="submit" name="submit" value = "inscription">Envoyer</button>
            </fieldset>
        </form>

    </section>
</section>
<?php include 'footer.php'?>
</body>
</html>
