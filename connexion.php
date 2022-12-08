<?php
include 'header.php'; // HEADER FILE LINK
include 'connect.php'; // CONNECT FILE LINK

if(isset($_POST['submit'])) {
    $login = $_POST['login']; // stock input in variables
    $password = $_POST['password']; // stock password

    $sql = "SELECT * FROM utilisateurs WHERE login = :login"; // request SQL for compare the login in DDB with placeholder
    $sql_exe = $conn->prepare($sql); // prepare request
    $sql_exe->bindParam(":login", $login); // bind value to placeholder
    $sql_exe->execute(); // execute query
    $results = $sql_exe->fetch(PDO::FETCH_ASSOC); // fetch results in assoc array

    if ($results !== false) { // if results is not false so user exist
        $hashedPassword = $results["password"]; // stock hashed password stocked in the BDD in this variable
        if (password_verify($password, $hashedPassword)) { //verify matches
            $_SESSION['login'] = $login;
            header("location: profil.php");

        } else {
            echo "<p id='error'>Le mot de passe est incorrect. </p>";
        }
    } else {
        echo "<p id='error'>L'utilisateur n'existe pas. </p>";
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
    <title>Connexion</title>
</head>
<body>
<section class="container_formulaire">
    <h1> Connectez-vous </h1>
    <section id="formulaire">
        <form method="post" name="register">
            <fieldset>
                <legend> Entrez votre login et votre mot de passe </legend>
                <label>Votre login </label> <br>
                <input type = "text" name = "login" placeholder="entrez votre login"> <br>
                <label>Mot de passe</label> <br>
                <input type = "password" name = "password" placeholder="mot de passe"> <br>
                <button type="submit" name="submit" value = "inscription">Connexion</button>
            </fieldset>
        </form>
    </section>
</section>
<?php include 'footer.php'?>
</body>
</html>