<?php
include 'connect.php';
include 'header.php';

if(!empty($_SESSION)) {
    $login = $_SESSION['login'];
    $sql = "SELECT * FROM utilisateurs WHERE login = :login";
    $sql_exe = $conn->prepare($sql);
    $sql_exe->bindParam(":login", $login); // bind value to placeholder
    $sql_exe->execute(); // execute query
    $results = $sql_exe->fetch(PDO::FETCH_ASSOC); // fetch results in assoc array
    $login = $results['login'];
    $password = $results['password'];

    if(isset($_POST['submit'])){
        if($login != $_POST['login']){
            $sql1 = "UPDATE utilisateurs SET login='{$_POST['login']}' WHERE login= :login";
            $sql1_exe = $conn->prepare($sql1);
            $sql1_exe->bindParam(":login", $login);
            $sql1_exe->execute();
            $_SESSION['login'] = $_POST['login'];
            echo "Votre login a bien été changé par" . $_POST['login'] ."<br>";

        } if($password != $_POST['password']){
            $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql2 = "UPDATE utilisateurs SET password='$new_password' WHERE password= :password";
            $sql2_exe = $conn->prepare($sql2);
            $sql2_exe->bindParam(":password", $password);
            $sql2_exe->execute();
            echo "Votre login a bien été changé par" . $_POST['password'] ."<br>";
        }
        header('Refresh: 1; url=profil.php');
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
    <title>Page de profil</title>
</head>
<body>
<section class="container_formulaire">
    <p id="p_profil"><?php echo 'Vous êtes connecté.e en tant que ' . $_SESSION['login'];?> </p>
    <h1>Votre profil</h1>

    <br>
    <br>
    <section id="tableau">
        <table>
            <form method="post">
                <thead>
                <td>Login</td>
                <td>Mot de passe</td>
                </thead>
                <tbody>
                <tr>
                    <td><input id="input_profil" name="login" value="<?php echo $results['login'] ?>"required></td>
                    <td><input type="password" id="input_profil" name="password" value="<?php echo $results['password'] ?>"></td>
                </tr>
                </tbody>
                <button class="delete" type="submit" name="delete">Supprimer mon compte</button>
                <button class="modifier" type="submit" name="submit">Modifier</button>
            </form>
        </table>
    </section>


</section>

<?php include 'footer.php'?>
</body>
</html>
