
    <!-- tukaj se bo vključevala koda pogledov, ki jih bodo nalagali kontrolerji -->
    <!-- klic akcije iz routes bo na tem mestu zgeneriral html kodo, ki bo zalepnjena v našo predlogo -->
    <?php require_once('routes.php'); ?> 

    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="/" class="nav-link px-2 text-body-secondary">Domov</a></li>
            <?php
                if(isset($_SESSION["USER_ID"])){
                    ?>
                    <li class="nav-item"><a href="/articles/create" class="nav-link px-2 text-body-secondary">Objavi novico</a></li>
                    <li class="nav-item"><a href="/articles/list" class="nav-link px-2 text-body-secondary">Moje novice</a></li> <!-- Dodan gumb "Moje novice" -->
                    <li class="nav-item"><a href="/users/edit" class="nav-link px-2 text-body-secondary">Uredi profil</a></li>
                    <li class="nav-item"><a href="/auth/logout" class="nav-link px-2 text-body-secondary">Odjava</a></li>
                    <?php
                } else{
                    ?>
                    <li class="nav-item"><a href="/auth/login" class="nav-link px-2 text-body-secondary">Prijava</a></li>
                    <li class="nav-item"><a href="/users/create" class="nav-link px-2 text-body-secondary">Registracija</a></li>
                    <?php
                }
                ?>
            </ul>
            <p class="text-center text-body-secondary">© UM FERI, Novice</p>
        </footer>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>