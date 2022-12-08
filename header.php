<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Karla&display=swap');

    ul {
        display: flex;
        list-style: none;
        justify-content: center;
    }

    li {
        padding-top: 20px;
        padding-right: 30px;
        padding-left: 10px;

    }

    a {
        text-decoration: none;
        color: rgb(55 37 128);

    }


    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;

    }

    header {
        width: 100%;
        height: 80px;
        background: rgb(226 219 255);
        font-family: 'Karla', sans-serif;

    }

    #accueil:hover {
        color: #4B49FF;
    }
    .button_connect {
        border: 2px solid #4B49FF;
        color: #4B49FF;
        border-radius: 25px;
        padding: 8px 12px;
    }

    .button_connect:hover {
        background: rgb(203 196 230);
        color: #452F9F;
        border: 2px solid #452F9F;
        transition: ease-in 100ms;
    }

    .button_inscription {
        border: 2px solid rgb(109 74 255);
        background: rgb(109 74 255);
        border-radius: 25px;
        padding: 8px 12px;
        color: #FFF;
    }

    .button_inscription:hover{
        border: 2px solid #452F9F;
        background: #452F9F;
        transition: ease-in 100ms;
    }

    .button_deconnexion {
        border: 2px solid rgb(109 74 255);
        background: rgb(109 74 255);
        border-radius: 25px;
        padding: 8px 12px;
        color: #FFF;
    }

    .button_deconnexion:hover {
        border: 2px solid #452F9F;
        background: #452F9F;
        transition: ease-in 100ms;
    }

</style>

<?php
session_start();
if (!empty($_SESSION['login'])){
    echo '<header>
        <ul>
            <li><a href="index.php">ACCUEIL</a></li>
            <li><a href="profil.php">PROFIL</a></li>
            <li><a href="livre-or.php">LIVRE D\'OR</a></li>
             <li><a href="commentaire.php">ÉCRIRE UN COMMENTAIRE</a></li>
            <li><a href="logout.php" class="button_deconnexion">DÉCONNEXION</a></li>
        </ul>
    </header>';
}else{
    echo '
        <header>
            <ul>
                <li><a href="index.php" id="accueil">ACCUEIL</a></li>
                 <li><a href="livre-or.php">LIVRE D\'OR</a></li>
                <li><a href="connexion.php" class="button_connect">CONNEXION</a></li>
                <li><a href="inscription.php" class="button_inscription">INSCRIPTION</a></li>
                
            </ul>
        </header>';
}



?>


<body>

</body>
</html>










