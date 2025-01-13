<?php
session_start(); // Munkamenet indítása

// Ha már be van jelentkezve a felhasználó, irányítsuk át a főoldalra
if (isset($_SESSION['user'])) {
    header("Location: index.php"); // Átirányítás a főoldalra
    exit(); // Megállítja a további kód futtatását
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'header.php'; ?>
    </header>
        <main class="flex-grow-1">
        <div class="registration-style form">
            <header>Regisztráció</header>
            <?php
            if ($_SERVER["REQUEST_METHOD"]=="POST"){
                if(isset($_POST["submit"])){
                    $fullName = $_POST["full_name"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $passwordRepeat = $_POST["repeat_password"];

                    //Jelszó hashelése
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    $errors = array();
                    //Hibaüzenetek
                    if(empty($fullName) AND empty($email) AND empty($password) AND empty($passwordRepeat)){
                    array_push($errors,"Az összes mező kitöltése kötelező!");
                    }
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){
                        array_push($errors,"Az e-mail cím formátuma nem megfelelő!");
                    }
                    if(strlen($password) < 8){
                        array_push($errors,"A jelszónak legalább 8 karakter hosszúnak kell lennie!");
                    }
                    if($password !== $passwordRepeat){
                        array_push($errors,"A jelszavak nem egyeznek!");
                    }

                    require_once 'db_connection.php';
                    //Ellenőrzi, hogy van-e már ilyen e-mail cím az adatbázisban
                    $sql = "SELECT * FROM felhasznalok WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $rowCount = mysqli_num_rows($result);
                    if($rowCount > 0){
                        array_push($errors,"Ez az e-mail cím már foglalt!");                   
                    }

                    if(count($errors) > 0){
                        foreach($errors as $error){
                            echo "<div class='alert alert-danger'>" .$error. "</div>";
                        }  
                    }else{
                        //Ha nincs hiba, akkor regisztrálja az adatokat
                        $sql = "INSERT INTO felhasznalok (full_name, email, password) VALUES (?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareSmt = mysqli_stmt_prepare($stmt, $sql);
                        if($prepareSmt){
                            mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                            mysqli_stmt_execute($stmt);
                            echo "<div class='alert alert-success'>Sikeres regisztráció!</div>";
                        }else{
                            die("Valami hiba történt: ".mysqli_error($conn));
                        }
                    }
                }
            }
            ?>
            <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>">
                <label for="full_name">Teljes név:</label>
                <input type="text" name="full_name" placeholder="Teszt Elek">
                <label for="email">E-mail:</label>
                <input type="email" name="email" placeholder="example@gmail.com" >
                <label for="password">Jelszó:</label>
                <input type="password" name="password" placeholder="Minimum 8 karakter" >
                <label for="repeat_password">Jelszó újra:</label>
                <input type="password" name="repeat_password" placeholder="Minimum 8 karatker">
                <input type="submit" class="button" name="submit" value="Regisztráció">
            </form>
            <div class="signup">
                <span class="signup">Van már fiókja?
                <a href="log_in.php">Bejelentkezés</a>
                </span>
            </div>
        </div>
        </main>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>