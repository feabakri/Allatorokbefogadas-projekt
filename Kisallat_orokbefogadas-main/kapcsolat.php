<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapcsolat</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'header.php'; ?>
    </header>
    <main class="flex-grow-1 container kapcsolat-style">
            <h1 class="row">A weboldalról:</h1>
            <p class="col-12">
            A főoldalon található az örökbefogadható állatok listája. Innen könnyen elnavigálhatsz más aloldalakra is, mint például az állatok listája vagy az információs oldalak.
            </p>
            <h2 class="row">Regisztráció, bejelentkezés</h2>
            <p class="col-12">
                Ha szeretnél állatot feltölteni az oldalra, regisztráció szükséges. A regisztráció során meg kell adnod néhány alapvető adatot, mint a neved, e-mail címed és egy jelszó. Az adataid biztonságban lesznek, és csak arra használjuk őket, hogy a felhasználói fiókodat kezeljük.
                A regisztráció után be tudsz jelentkezni az oldalra. Miért hasznos?
                A személyes fiókodban nyomon követheted az általad feltöltött állatokat és az általad küldött üzeneteket.
                Bejelentkezés után hozzáférsz a feltöltés funkcióhoz, ahol állatokat adhatsz hozzá a rendszerhez.
            </p>
            <h2 class="row">Állatok megtekintése</h2>
            <p> 
                Ha valamelyik állat felkeltette az érdeklődésedet, kattints a nevére vagy a képére. Ekkor átkerülsz egy egyedi oldalra, ahol további információkat találhatsz az állatról, és kapcsolatba léphetsz az állat feltöltőjével.
            </p>
            <h2 class="row">Állat feltöltése</h2>
            <p>
                Ha segíteni szeretnél egy kisállatnak új otthont találni, az Állat feltöltése oldalon tölthetsz fel új kisállatokat. Ehhez regisztráció és bejelentkezés szükséges. Az űrlap kitöltésével adhatsz hozzá képeket, és részletes információkat az állatról (pl. életkor, fajtajellemzők, és hogy milyen típusú otthont keres).
                A saját profilodon megtekintheted az általad feltöltött állatokat, szerkesztheted vagy törölheted őket, ha már gazdira találtak.
            </p>
            <h2 class="row">Kapcsolat és támogatás</h2>
            <p>
                Bármilyen kérdés vagy probléma esetén fordulj hozzánk e-mail vagy telefon segítségével. Itt megírhatod, kérdéseket tehetsz fel nekünk, ha problémád akad a weboldal használatával, vagy ha más jellegű kérdésed van az örökbefogadási folyamattal kapcsolatban.
            </p>
            <div class="row pt-10 mt-10 fw-bold">
                <p class="col-6 text-center">E-mail:</p>
                <p class="col-6 text-center">Telefonszám:</p>
            </div>
            <div class="row pt-10 fst-italic">
                <p class="col-6 text-center"><a href="mailto:petgamerlol@gmail.com">kisallatkisegito@gmail.com</a></p>
                <p class="col-6 text-center">36301234567</p>
            </div>
            <p class="text-end mb-1">
                <a href="index.php"><small class="text-muted">Vissza a kezdőoldalra</small></a>
            </p>
        </main>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>