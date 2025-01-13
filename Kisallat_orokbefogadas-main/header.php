<?php
    //Megnézzük hogy a session el van-e indítva és ha nincs akkor elindítjuk.
    if (session_status() == PHP_SESSION_NONE && isset($_COOKIE[session_name()])) {
        session_start();
    }
?>   
<header class="container-fluid site-header fixed-top mt-3">
    <div class="d-flex justify-content-between align-items-center">
        <div class="col-md-6 d-flex align-items-center">
            <a href="index.php"><img src="img/icon.webp" alt="Logo" style="max-height: 80px;"></a>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col text-end other-sites">
                    <a href="fotozastippek.php">Fotózási tippek</a>
                    <a href="kapcsolat.php">A weboldalról</a>
                </div>
            </div>
            <div class="row">
                <div class="col text-end">

                    <!--Ellenőrzük hogy a felhasználó bevan-e jelentkezve.-->
                    <?php if(isset($_SESSION['user'])): ?>

                        <!--Ha igen akkor a 2 gomb megváltozik-->
                        <a href="upload_animal.php" class="btn btn-success">Állat feltöltés</a> 
                        <div class="dropdown d-inline-block">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-user"></i><?php echo $_SESSION['full_name']; //A felhasználó nevét írjuk ki a gombra.?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="logout.php">Kijelentkezés</a></li>
                            </ul>
                        </div>

                    <!--Ha nem akkor az alap 2 gomb van.-->
                    <?php else: ?> 
                        <a href="log_in.php" class="btn btn-success">Bejelentkezés</a>
                        <a href="sign_up.php" class="btn btn-secondary btn-reg">Regisztráció</a>
                    <?php endif; ?>

                </div>
            </div>
        </div> 
    </div>
</header>

<button id="scrollToTopBtn" class="scroll-to-top" title="Az oldal tejejére">↑</button>
    <script>
        // Az oldal tetejére görgető gomb
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');

        // Gomb kattintás esemény
        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Gomb megjelenítése görgetéskor
        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                scrollToTopBtn.style.display = 'block';
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        });
    </script>

<!--Dropdon menühoz bootstrap + fontawesome + errorhandling.js-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/d16c0b5a00.js" crossorigin="anonymous"></script>
<script src="errorhandling.js"></script>

<!--Bejelentkezés utáni modal-->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bejelentkezés sikeres</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Sikeresen bejelentkezés! 
            Most már megnézheti örökbefogadható állatokat és akár fel is tölthet a weboldalra.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
        </div>
        </div>
    </div>
</div>
<?php
    // Show the modal if the user has just logged in
    if (isset($_SESSION['user']) && isset($_SESSION['just_logged_in'])) {
        echo "<script>
                var myModal = new bootstrap.Modal(document.getElementById('loginModal'));
                myModal.show();
              </script>";
        // Unset the just_logged_in flag so the modal doesn't show on subsequent page loads
        unset($_SESSION['just_logged_in']);
    }
?>
<!--Kijelentkezés utáni modalhoz bootstrap-->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kijelentkezés sikeres</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Sikeres kijelentkezés!
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
        </div>
        </div>
    </div>
</div>
<?php
    //Megjeleníti a modal-t ha a felhasználó kijelentkezett
    if (isset($_GET['logged_out']) && $_GET['logged_out'] == 'true') {
        echo "<script>
                var myModal = new bootstrap.Modal(document.getElementById('logoutModal'));
                myModal.show();
              </script>";
    }
?>