<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A weboldalról</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'header.php'; ?>
    </header>
        <main class="flex-grow-1 container fotozastippek-style">
            <h1 class="row">Fotózási tippek</h1>
            <p class="col-12">
                Néhány tipp a háziállat fotózásához, hogy jobb képeket készíts, ő pedig  így hamarabb találjon gazdira! 
                Az alábbi ötletek sok lefotózott, és rövid időn belül sikeresen örökbefogadott szőrmók marketingezésének tapasztalatai.
            </p>
            <h2 class="row">Háttér:</h2>
            <p class="col-12">
            Amennyiben lakásban fotózol, érdemes egy homogén, egyszínű  hátteret választani, például egy takarót, plédet, nagyobb párnát. Ha lakáson kívül fotózod, próbáld meg fűben, vagy valami olyan közegben, ami akár jópofává, akár kedvesebbé teszi a képet. Használhatsz kellékeket is, kölykök például nagyon jól mutatnak fonott vesszőkosárban. 
            </p>

            <img class="fotozasitippek-hatterfoto" src="img/hatterfoto.jpg" alt="Háttér fotózási tippek">

            <h2 class="row">Kompozíció:</h2>
            <p class="col-12">
                Készíts többféle képet a háziállatról, közelit és egész alakosat is. Fontos hogy legyen közte olyan ahol látszanak a szemei, és belenéz a kamerába.
            </p>

            <div class="image-gallery">
                <img src="img/kompozicio-1.jpg" alt="Kompozíció példa 1">
                <img src="img/kompozicio-2.jpg" alt="Kompozíció példa 2">
                <img src="img/kompozicio-3.jpg" alt="Kompozíció példa 3">
            </div>

            <h2 class="row">Időzítés:</h2>
            <p class="col-12">
                Nem minden állatnak van türelme pózolni. Ezért vagy délutáni sziesztája közben kapd el, vagy kérj segítséget a fotózáshoz, és  egyikőtök keltse fel a figyelmét, és irányítsa egy jutifalatra, így rábírhatjátok hogy egy helyben maradjon a kép elkészültéig. Ha  fényképeződ beállításai megengedik, vedd minél rövidebbre a záridőt és használj (nem túl erős) vakut, így nem fog „bemozdulni" a képen.
            </p>
            <p class="text-end mb-0">
                <a href="index.php"><small class="text-muted">Vissza a kezdőoldalra</small></a>
            </p>
        </main>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>