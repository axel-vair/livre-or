<?php
include 'connect.php';
include 'header.php';

if(!empty($_SESSION)) {
    $login = $_SESSION['login'];
    $sql = 'SELECT * FROM utilisateurs WHERE login = :login';
    $sql_exe = $conn->prepare($sql);
    $sql_exe->bindParam(':login', $login);
    $sql_exe->execute();
    $results = $sql_exe->fetch(PDO::FETCH_ASSOC);
    $password = $results['password'];

    if (isset($_POST['submit'])) {
        $sql2 = 'SELECT COUNT(*) FROM utilisateurs WHERE login = :login';
        $sql_exe2 = $conn->prepare($sql);
        $sql_exe2->bindParam(':login', $_POST['login']);
        $sql_exe2->execute();
        $results2 = $sql_exe2->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($results2)){
            echo "<p id='error'>Le login est déjà utilisé</p>";

        } else {
            $sql1 = "UPDATE utilisateurs SET login='{$_POST['login']}' WHERE login = :login";
            $sql1_exe = $conn->prepare($sql1);
            $sql1_exe->bindParam(":login", $login);
            $sql1_exe->execute();
            $_SESSION['login'] = $_POST['login'];
            echo "<p id='valid'>Votre login a bien été changé par " . $_POST['login'] . "</p>" . "<br>";

        }
        if ($password != $_POST['password']) {
            $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql2 = "UPDATE utilisateurs SET password='$new_password' WHERE password= :password";
            $sql2_exe = $conn->prepare($sql2);
            $sql2_exe->bindParam(":password", $password);
            $sql2_exe->execute();
            echo "<p id='valid'>Votre mot de passe a bien été changé</p>";
        }
        header('Refresh: 1; url=profil.php');
    }


    if (isset($_POST['delete'])) { // if user push delete button so delete all data from bdd and destroy session then redirect.
        $sql_delete = "DELETE FROM utilisateurs WHERE login='$login'";
        $result_delete = $conn->query($sql_delete);
        echo "Vos données ont été supprimées";
        session_destroy();
        header('Location: index.php');
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
