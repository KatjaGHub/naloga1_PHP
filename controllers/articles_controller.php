
<?php
/*
    Controller za novice. Vključuje naslednje standardne akcije:
        index: izpiše vse novice
        show: izpiše posamezno novico
        
    TODO:
        list: izpiše novice prijavljenega uporabnika
        create: izpiše obrazec za vstavljanje novice
        store: vstavi novico v bazo
        edit: izpiše vmesnik za urejanje novice
        update: posodobi novico v bazi
        delete: izbriše novico iz baze
*/
require_once('connection.php');
class articles_controller
{
    public function index()
    {
        //s pomočjo statične metode modela, dobimo seznam vseh novic
        //$ads bo na voljo v pogledu za vse oglase index.php
        $articles = Article::all();

        //pogled bo oblikoval seznam vseh oglasov v html kodo
        require_once('views/articles/index.php');
    }

    public function show()
    {
        //preverimo, če je uporabnik podal informacijo, o oglasu, ki ga želi pogledati
        if (!isset($_GET['id'])) {
            return call('pages', 'error'); //če ne, kličemo akcijo napaka na kontrolerju stran
            //retun smo nastavil za to, da se izvajanje kode v tej akciji ne nadaljuje
        }
        //drugače najdemo oglas in ga prikažemo
        $article = Article::find($_GET['id']);
        require_once('views/articles/show.php');
    }

    public function create(){
        require_once('views/articles/create.php');
    }

    public function store() {
        // Preverjanje, ali je uporabnik poslal podatke preko POST metode
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Tukaj bi morali validirati podatke!
    
            // Ustvarimo novo instanco Article modela
            //Nastavimo user_id iz seje
            session_start(); // Preveri če imaš tukaj sejo že narejeno
            $user_id = $_SESSION["user_id"];
    
            $title = $_POST['title'];
            $abstract = $_POST['abstract'];
            $text = $_POST['text'];
    
            $article = Article::create($title, $abstract, $text, $user_id);
    
            if ($article) {
                // Uspešno ustvarjeno
                header('Location: index.php?controller=articles&action=show&id=' . $article->id);
                exit();
            } else {
                // Napaka pri ustvarjanju
                echo "Napaka pri ustvarjanju novice!";
            }
        } else {
            // Če uporabnik ni poslal podatkov preko POST metode, ga preusmerimo na stran za ustvarjanje novice
            header('Location: index.php?controller=articles&action=create');
            exit();
        }
    }

    public function edit() {
        // Preverimo, če je ID podan
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }

        // Poiščemo novico z danim ID-jem
        $article = Article::find($_GET['id']);

        // Če novice ne najdemo, vrnemo napako
        if (!$article) {
            return call('pages', 'error');
        }

        // Prikažemo pogled za urejanje novice
        require_once('views/articles/edit.php');
    }

    public function update() {
        // Preverimo, če je uporabnik poslal podatke preko POST metode
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Preverimo, če je ID podan
            if (!isset($_POST['id'])) {
                echo "ID ni podan v POST!";  // Dodaj to
                return call('pages', 'error');
            }
    
            // Poiščemo novico z danim ID-jem
            $article = Article::find($_POST['id']);
    
            // Če novice ne najdemo, vrnemo napako
            if (!$article) {
                echo "Novica ne obstaja v bazi!";  // Dodaj to
                return call('pages', 'error');
            }
    
            // Tukaj bi morali validirati podatke!
    
            // Posodobimo atribute Article modela iz podatkov, pridobljenih iz POST metode
            $article->title = $_POST['title'];
            $article->abstract = $_POST['abstract'];
            $article->text = $_POST['text'];
            // Dodajte še druge atribute, če jih ima vaš Article model
    
            // Shranimo spremembe v bazo
            $article->update($_POST['title'], $_POST['abstract'], $_POST['text']);
    
            // Preusmeritev na stran s seznamom novic (index)
            header('Location: index.php?controller=articles&action=index');
            exit();
        } else {
            // Če uporabnik ni poslal podatkov preko POST metode, ga preusmerimo na stran s seznamom novic (index)
            header('Location: index.php?controller=articles&action=index');
            exit();
        }
    }

    public function delete() {
        // Preverimo, če je ID podan
        if (!isset($_GET['id'])) {
            echo "ID ni podan!";   // PREVERI
            return call('pages', 'error');
        }
    
        // Poiščemo novico z danim ID-jem
        $article = Article::find($_GET['id']);
    
        // Če novice ne najdemo, vrnemo napako
        if (!$article) {
            echo "Novica ne obstaja!";   // PREVERI
            return call('pages', 'error');
        }
    
        // Izbrišemo novico iz baze
        $article->delete();
    
        // Preusmeritev na stran s seznamom novic (index)
        header('Location: index.php?controller=articles&action=index');
        exit();
    }

    public function list() {
        // Predpostavljamo, da imate v seji shranjen ID prijavljenega uporabnika
        
        if (isset($_SESSION['USER_ID'])) {
            $user_id = $_SESSION['USER_ID'];
                        // Poiščemo novice, ki jih je ustvaril prijavljeni uporabnik
            $articles = Article::findByUserId($user_id); // Predpostavka, da imate metodo findByUserId v Article modelu
            
            // Prikažemo pogled s seznamom novic prijavljenega uporabnika
            require_once('views/articles/list.php');
        } else {
            // Če uporabnik ni prijavljen, ga preusmerimo na stran za prijavo
            header('Location: index.php?controller=pages&action=login'); // Primer poti do strani za prijavo
            exit();
        }
    }
}