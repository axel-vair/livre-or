<?php
include 'header.php'; // HEADER LINK

if(!empty($_SESSION)){
    echo "<h1>Bonjour {$_SESSION['login']} </h1>";

}else{
    echo "<h1>Bienvenue ! Inscrivez-vous pour vous connecter.</h1>";
}
?>


<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" type="text/css" href="or-style.css">
</head>
<body>
<h2>Retrouvez-moi sur les réseaux sociaux :  </h2>
<div class="logo">
    <a id="index_git" href="https://github.com/axel-vair"><img class="git" src="github.png"></a>
    <a id="index_link" href="https://linkedin.com/axel-vair"><img class="link" src="linkedin.png"></a>
</div>
<div class="emoji">
    <img class="emojipic" src="axelemoji.jpg">
</div>

<?php include 'footer.php'?>
</body>
</html>

