<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Állat információ feltöltés</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'header.php'; ?>
    </header>
        <main class="flex-grow-1">
            <div class="container upload_animal">
            <h1>Állat információ feltöltés</h1>                       
            <!--TESZT feltölteni adatbázisba pár állatot-->
            <?php
                if ($_SERVER["REQUEST_METHOD"]=="POST"){
                    if(isset($_POST["TEST_submit"])){
                        require_once 'db_connection.php';
                        //7db Teszt állat adatai
                        //Az állatok képeit __DIR__ eléréssel töltjük be, így nem számít az xammp helye, mert a __DIR__ a fájl helyét adja meg
                        $test_animals = [
                            [
                                'animal_name' => 'Buksi',
                                'animal_age' => 3,
                                'animal_type' => 'kutya',
                                'animal_gender' => 'hím',
                                'animal_size' => 'közepes',
                                'animal_breed' => 'keverék',
                                'animal_description' => 'Buksi egy nagyon kedves és barátságos kutya, aki imád játszani és sétálni...',
                                'animal_image' => __DIR__ . '/img/teszt1.jpg',
                                'created_at' => '2024-08-11 13:04:33'
                            ],
                            [
                                'animal_name' => 'Rex',
                                'animal_age' => 4,
                                'animal_type' => 'kutya',
                                'animal_gender' => 'hím',
                                'animal_size' => 'nagy',
                                'animal_breed' => 'németjuhász',
                                'animal_description' => 'Rex egy hűséges és védelmező kutya, aki gyorsan tanul és kiváló társ a hosszú sétákhoz...',
                                'animal_image' => __DIR__ . '/img/teszt2.jpg',
                                'created_at' => '2024-07-05 10:14:28'
                            ],
                            [
                                'animal_name' => 'Bella',
                                'animal_age' => 2,
                                'animal_type' => 'kutya',
                                'animal_gender' => 'nőstény',
                                'animal_size' => 'nagy',
                                'animal_breed' => 'németjuhász',
                                'animal_description' => 'Bella intelligens és aktív, szeret tanulni és boldogan fogad minden figyelmet...',
                                'animal_image' => __DIR__ . '/img/teszt3.jpg',
                                'created_at' => '2024-06-22 15:35:45'
                            ],
                            [
                                'animal_name' => 'Lucy',
                                'animal_age' => 3,
                                'animal_type' => 'kutya',
                                'animal_gender' => 'nőstény',
                                'animal_size' => 'nagy',
                                'animal_breed' => 'golden retriever',
                                'animal_description' => 'Lucy türelmes és barátságos, szereti a gyerekeket és nagyszerű családi kutya...',
                                'animal_image' => __DIR__ . '/img/teszt4.jpg',
                                'created_at' => '2024-05-20 17:10:56'
                            ],
                            [
                                'animal_name' => 'Chico',
                                'animal_age' => 1,
                                'animal_type' => 'kutya',
                                'animal_gender' => 'hím',
                                'animal_size' => 'kicsi',
                                'animal_breed' => 'chihuahua',
                                'animal_description' => 'Chico apró termetű, de nagy szívű kutyus, akinek mindig van egy kis morgása az idegeneknek...',
                                'animal_image' => __DIR__ . '/img/teszt5.jpg',
                                'created_at' => '2024-04-11 11:55:03'
                            ],
                            [
                                'animal_name' => 'Rocky',
                                'animal_age' => 3,
                                'animal_type' => 'kutya',
                                'animal_gender' => 'hím',
                                'animal_size' => 'közepes',
                                'animal_breed' => 'pitbull',
                                'animal_description' => 'Rocky egy erős és hűséges kutya, aki gyorsan kötődik a gazdájához és védi a családját...',
                                'animal_image' => __DIR__ . '/img/teszt6.jpg',
                                'created_at' => '2024-03-15 09:37:26'
                            ],
                            [
                                'animal_name' => 'Pöttyös',
                                'animal_age' => 1,
                                'animal_type' => 'macska',
                                'animal_gender' => 'hím',
                                'animal_size' => 'közepes',
                                'animal_breed' => 'tarka',
                                'animal_description' => 'Pöttyös aktív és játékos macska, aki szeret a játékok után vadászni és ugrálni...',
                                'animal_image' => __DIR__ . '/img/teszt7.jpg',
                                'created_at' => '2024-07-02 16:14:55'
                            ],
                        ];
                        foreach ($test_animals as $test_animal) {
                            // Kép beolvasása és bináris adatokká konvertálása
                            $imageData = file_get_contents($test_animal['animal_image']);
                            $imageData = $conn->real_escape_string($imageData);
                            
                            // Adatok feltöltése az adatbázisba
                            $sql = "INSERT INTO animals (animal_name, animal_age, animal_type, animal_gender, animal_size, animal_breed, animal_description, animal_image, created_at) VALUES (
                                '{$test_animal['animal_name']}',
                                {$test_animal['animal_age']},
                                '{$test_animal['animal_type']}',
                                '{$test_animal['animal_gender']}',
                                '{$test_animal['animal_size']}',
                                '{$test_animal['animal_breed']}',
                                '{$test_animal['animal_description']}',
                                '$imageData',
                                '{$test_animal['created_at']}'
                            )";
                        
                            // Ellenőrizzük, hogy sikeres-e a feltöltés
                            if ($conn->query($sql) === TRUE) {
                                //Ha igen akkor kiírjuk a sikeres feltöltést
                                echo "<div class='alert alert-success'>Sikeres test feltöltés: {$test_animal['animal_name']}</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Valami hiva történt: $sql $conn->error</div>";
                            }
                        }
                        // Bezárjuk a kapcsolatot, hogy ne kérje le újra és újra az adatokat
                        $conn->close();
                    }
                }
            ?>
                <!--Az állat adatainak feltöltése az adatbázisba-->
                <?php
                    if ($_SERVER["REQUEST_METHOD"]=="POST"){
                        if(isset($_POST["submit"])){
                            //Itt is muszáj isset-et használni mert ha nem töltik ki a select formot akkor nem lesz értéke a változónak és warning hibaüzenetet küld.
                            $animal_name = isset($_POST["animal_name"]) ? $_POST["animal_name"] : '';
                            $animal_age = isset($_POST["animal_age"]) ? $_POST["animal_age"] : '';
                            $animal_type = isset($_POST["animal_type"]) ? $_POST["animal_type"] : 'default';
                            $animal_gender = isset($_POST["animal_gender"]) ? $_POST["animal_gender"] : 'default';
                            $animal_size = isset($_POST["animal_size"]) ? $_POST["animal_size"] : 'default';
                            $animal_breed = isset($_POST["animal_breed"]) ? $_POST["animal_breed"] : '';
                            $animal_description = isset($_POST["animal_description"]) ? $_POST["animal_description"] : '';
                            $created_at = date("Y-m-d H:i:s"); //Aktuális időpont

                            $errors = array();
                            //Hibaüzenetek
                            if(empty($animal_name) || empty($animal_age) || empty($animal_type) || empty($animal_gender) || empty($animal_size) || empty($animal_breed) || empty($animal_description)) {
                                array_push($errors,"A az összes mező kitöltése kötelező!");
                            }
                            if($animal_type == "default"){
                                array_push($errors, "Kérem válasszon egy faj opciót!");
                            }
                            if($animal_gender == "default"){
                                array_push($errors, "Kérem válasszon egy ivar opciót!");
                            }
                            if($animal_size == "default"){
                                array_push($errors, "Kérem válasszon egy méret opciót!");
                            }
                            
                            //Kezeljük a képfeltöltést
                            if (isset($_FILES["animal_image"])) {
                                //Megnézzük, hogy van-e hiba a képfeltöltésnél
                                if ($_FILES["animal_image"]["error"] == 0) {
                                    //Ha nincs semmi hiba akkor beolvassa a képet, a ["tmp_name"] a fájl ideiglenes nevét adja meg, a file_get_contents függvény pedig beolvassa a fájlt és visszaadja a tartalmát
                                    $animal_image = file_get_contents($_FILES["animal_image"]["tmp_name"]);
                                //Ha hiba van a képfeltöltésnél akkor ezt a hibaüzenetet hívja meg
                                } else {
                                    array_push($errors, "Kérem töltsön fel egy képet! Hiba: " . $_FILES["animal_image"]["error"]);
                                }
                            //Ha pedig nincs fájl feltöltve akkor ezt a hibaüzenetet hívja meg
                            } else {
                                array_push($errors, "Kérem töltsön fel egy képet! A fájl nem található.");
                            }

                            require_once 'db_connection.php';
                            if(count($errors) > 0){
                                foreach($errors as $error){
                                    echo "<div class='alert alert-danger'>" .$error. "</div>";
                                }  
                            }else{
                                //Ha nincs semmi hiba akkor feltöltjük az adatokat
                                $sql = "INSERT INTO animals (animal_name, animal_age, animal_type, animal_gender, animal_size, animal_breed, animal_description, animal_image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                $stmt = mysqli_stmt_init($conn);
                                $prepareSmt = mysqli_stmt_prepare($stmt, $sql);
                                if($prepareSmt){
                                    //Minden string (s) kivéve az életkor (i) és a kép (b)
                                    mysqli_stmt_bind_param($stmt, "sssssssss", $animal_name, $animal_age, $animal_type, $animal_gender, $animal_size, $animal_breed, $animal_description, $animal_image, $created_at);
                                    mysqli_stmt_execute($stmt);
                                    echo "<div class='alert alert-success'>Sikeres feltöltés!</div>";
                                }else{
                                    die("Valami hiba történt: ".mysqli_error($conn));
                                }
                            }
                    }
                }
                ?>
                <div class="row ps-1">
                    <div class="col-xl-6 col-md-12">
                        <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" class="form_upload_animal" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-xl-6 col-md-12">
                                    <label for="animal_name">Állat neve:</label>
                                    <input type="text" class="form-control" id="animal_name" name="animal_name" placeholder="Pl.: Borzi">
                                </div>
                                <div class="form-group col-xl-6 col-md-12">
                                    <label for="animal_age">Életkor:</label>
                                    <input type="number" class="form-control" id="animal_age" name="animal_age" placeholder="Pl.: 3" min="1" max="25" inputmode="numeric">
                                    <small id="animal_age_help" class="text-muted form-text">Ha nem tudják az állat pontos életkorát akkor egy közeli értéket adjanak meg.</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xl-6 col-md-12">
                                    <label for="animal_type">Faj:</label>
                                    <select class="form-select" id="animal_type" name="animal_type">
                                        <option value="default" selected disabled hidden>Kérem válasszon</option>
                                        <option value="kutya">Kutya</option>
                                        <option value="macska">Macska</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-6 col-md-12">
                                    <label for="">Ivar:</label>
                                    <select class="form-select" id="animal_gender" name="animal_gender">
                                        <option value="default" selected disabled hidden>Kérem válasszon</option>
                                        <option value="hím">Hím</option>
                                        <option value="nőstény">Nőstény</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xl-6 col-md-12">
                                    <label for="animal_size">Méret:</label>
                                    <select class="form-select" id="animal_size" name="animal_size">
                                        <option value="default" selected disabled hidden>Kérem válasszon</option>
                                        <option value="kicsi">Kicsi</option>
                                        <option value="közepes">Közepes</option>
                                        <option value="nagy">Nagy</option>
                                    </select>
                                    <small id="animal_size_help" class="text-muted">Az állat méretét a következőképpen lehet meghatározni: kicsi (pl.: chihuahua), közepes (pl.: beagle), nagy (pl.: németjuhász).</small>
                                </div>
                                <div class="form-group col-xl-6 col-md-12">
                                    <label for="animal_breed">Fajta:</label>
                                    <input type="text" class="form-control" id="animal_breed" name="animal_breed" placeholder="Pl.: Németjuhász">
                                    <small id="animal_breed_help" class="text-muted form-text">Ha nem tudják az állat pontos fajtáját akkor "keverék" fajtát adják meg.</small>
                                </div>
                            </div>
                    </div>
                    <!--Állat előnézet megjelenítése a jobb oldalon-->
                    <div class="col-xl-6 col-md-12 form_upload_animal preview_animal_box">
                        <div class="animal-box mx-auto">
                        <img id="preview_image" src="img/animal_preview_img.jpg" alt="Állatról egy kép">
                        <h3 id="preview_name">Neve: </h3>
                        <p id="preview_age">Kor: </p>
                        <p id="preview_gender">Ivar: </p>
                        </div>
                    </div>
                </div>
                    <div class="form-group ps-1 lower-upload-animal">
                        <label for="animal_description">Leírás:</label>
                        <textarea class="form-control custom-textarea" id="animal_description" name="animal_description" rows="3" placeholder="Pl.: Borzi egy nagyon kedves kutya, aki szeret játszani és sétálni."></textarea>
                    </div>
                    <div class="form-group ps-1 lower-upload-animal">
                        <label for="animal_image">Kép:</label>
                        <input type="file" class="form-control custom-file-input" id="animal_image" name="animal_image">
                    </div>
                    <!--TODO: Ide lehet kéne egy mező amibe meglehet adni a telefonszámot, amit nem muszáj megadni.-->
                    <button type="submit" name="submit" class="btn btn-success mt-3 mb-3">Feltöltés</button>
                </form>
            </div>
            <!--Teszt gomb amivel feltöltünk az adatbázisba 15 állatot (jobb felül van)-->
            <?php if(isset($_SESSION['user'])){
                    $current_user_id = $_SESSION['user'];
                    //Itt most a user id 2 lesz mert az az "admin" felhasználó
                    $specific_user_id = 2;
                }
                if($current_user_id == $specific_user_id) {?>
            <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data">
                <div class="test-button-for-upload"><button type="submit" name="TEST_submit">Test</button></div>
            </form>
            <?php } ?>
        </main>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>

 <!--Ez a script segít abban, hogy a felhasználó láthassa, hogy hogyan fog kinézni az állat információja a menüoldalon.-->
<script>
    document.getElementById('animal_name').addEventListener('input', function() {
        document.getElementById('preview_name').textContent = this.value;
    });

    document.getElementById('animal_age').addEventListener('input', function() {
        document.getElementById('preview_age').innerHTML = '<i class="far fa-calendar-alt me-1"></i>'+ this.value + ' éves';
    });

    document.getElementById('animal_gender').addEventListener('change', function() {
        if(this.value == 'hím'){
            document.getElementById('preview_gender').innerHTML = '<i class="fa-solid fa-mars"></i> ' + this.value;
        }else{
            document.getElementById('preview_gender').innerHTML = '<i class="fa-solid fa-venus"></i> ' + this.value;
        }
    });

    document.getElementById('animal_image').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('preview_image').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>