<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kisállat örökbefogadó</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'header.php'; ?>
    </header>
    <main class="flex-grow-1">
        <!--Kutya kép -->
        <div class="container-fluid kutya-hero"></div>
        <!--Szűrés + keresés rész -->
        <div class="container-fluid search-box pt-5 pb-3">
            <div class="row">
                <!-- Bal oldali szűrési opciók -->
                <div class="col-10">
                    <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>">
                    <fieldset>
                        <h2>Keresés név szerint</h2>
                        <div class="mb-3 ms-4">
                            <input id="Form_Adaption_Keywords" class="form-control" type="text" name="keywords" placeholder="Pl. Bogáncs">
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-12">
                                <p class="mb-0">Faj</p>
                                <ul role="listbox">
                                    <li role="option">
                                        <input class="checkbox" type="checkbox" name="species[]" value="kutya"><label>kutya</label>
                                    </li>
                                    <li role="option">
                                        <input class="checkbox" type="checkbox" name="species[]" value="macska"><label>macska</label>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-2 col-sm-12">
                                <p class="mb-0">Ivar</p>
                                <ul role="listbox">
                                    <li role="option">
                                        <input class="checkbox" type="checkbox" name="gender[]" value="hím"><label>hím</label>
                                    </li>
                                    <li role="option">
                                        <input class="checkbox" type="checkbox" name="gender[]" value="nőstény"><label>nőstény</label>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-2 col-sm-12">
                                <p class="mb-0">Méret</p>
                                <ul role="listbox">
                                    <li role="option">
                                        <input class="checkbox" type="checkbox" name="size[]" value="kicsi"><label>kicsi</label>
                                    </li>
                                    <li role="option">
                                        <input class="checkbox" type="checkbox" name="size[]" value="közepes"><label>közepes</label>
                                    </li>
                                    <li role="option">
                                        <input class="checkbox" type="checkbox" name="size[]" value="nagy"><label>nagy</label>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-2 col-sm-12">
                                <div>
                                    <p class="ps-0">Évtől</p>
                                    <input type="number" name="age_from" class="form-control-age" placeholder="0">
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-12">
                                <div>
                                    <p class="ps-0">Évig</p>
                                    <input type="number" name="age_to" class="form-control-age" placeholder="25">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <!--Jobb oldali rész -->
                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center col-sm-12">
                    <input id="Form_Adaption_action_doSearch" class="mb-2 action-button" type="submit" name="action_doSearch" value="Szűrés">
                    <a class="resetfields" href="index.php">Szűrés törlése</a>
                </div>
            </form>
            </div>
        </div>

        <!--Keresés, szűrés php -->
        <?php
        require_once 'db_connection.php';

        // Alap SQL lekérdezés
        $sql = "SELECT id, animal_name, animal_age,animal_type, animal_gender,animal_size,animal_breed,animal_description, animal_image FROM animals WHERE 1=1";

        // Szűrési feltételek
        if (!empty($_POST['keywords'])) {
            $keywords = $conn->real_escape_string($_POST['keywords']);
            $sql .= " AND animal_name LIKE '%$keywords%'";
        }

        if (!empty($_POST['species'])) {
            $species = array_map([$conn, 'real_escape_string'], $_POST['species']);
            $speciesList = "'" . implode("','", $species) . "'";
            $sql .= " AND animal_type IN ($speciesList)";
        }

        if (!empty($_POST['gender'])) {
            $gender = array_map([$conn, 'real_escape_string'], $_POST['gender']);
            $genderList = "'" . implode("','", $gender) . "'";
            $sql .= " AND animal_gender IN ($genderList)";
        }
        if (!empty($_POST['size'])) {
            $size = array_map([$conn, 'real_escape_string'], $_POST['size']);
            $sizeList = "'" . implode("','", $size) . "'";
            $sql .= " AND animal_size IN ($sizeList)";
        }

        if (!empty($_POST['age_from'])) {
            $ageFrom = (int)$_POST['age_from'];
            $sql .= " AND animal_age >= $ageFrom";
        }

        if (!empty($_POST['age_to'])) {
            $ageTo = (int)$_POST['age_to'];
            $sql .= " AND animal_age <= $ageTo";
        }

        // Eredmények lekérése
        $animals = [];
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $animals[] = $row;
            }
        } else {
            echo "<div class='alert alert-danger'>Hiba az adatbázis lekérdezése során.</div>";
        }
        ?>

        <!--Állatok megjelenítése az adatbázisból. -->
        <div class="container-fluid">
            <div class="row">
                <?php foreach ($animals as $animal): ?>
                    <div class="col-md-3 col-sm-12 animal-box">
                        <?php
                        // Bináris adat base64 formátumba konvertálása
                        $imageData = base64_encode($animal['animal_image']);
                        ?>
                        <!-- Az állatok képe, neve, életkora és neme (a képet muszáj volt base 64-ba encodeolni az adatbázisba így tudjuk elmenteni)-->
                        <img src="data:image/jpeg;base64,<?= $imageData ?>" alt="Kép betöltése sikertelen <?= htmlspecialchars($animal['animal_name']) ?>" class="animal-box-img">
                        <h3><?= htmlspecialchars($animal['animal_name']) ?></h3>
                        <p><i class="far fa-calendar-alt me-1"></i><?= htmlspecialchars($animal['animal_age']) ?> éves</p>
                        <p>
                            <!-- Megnézzük hogy milyen nemű és az alapján teszünk hozzá ikont -->
                            <?php if ($animal['animal_gender'] == 'hím'): ?>
                                <i class="fa-solid fa-mars"></i>
                            <?php elseif ($animal['animal_gender'] == 'nőstény'): ?>
                                <i class="fa-solid fa-venus"></i>
                            <?php endif; ?>
                            <?= htmlspecialchars($animal['animal_gender']) ?>
                        </p>

                        <!-- Az állatok részleteinek megtekintése, attól függően hogy a felhasználó bevan-e jelentkezve -->
                        <?php if (isset($_SESSION['user'])): ?>
                            <a href="animal_details.php?id=<?= htmlspecialchars($animal['id']) ?>" class="adopt-button">További részletek</a>
                        <?php else: ?>
                            <a href="log_in.php" class="adopt-button">Kérjük jelentkezzen be!</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </main>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>