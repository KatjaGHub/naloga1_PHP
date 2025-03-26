<?php
require_once('connection.php');
require_once 'users.php'; 

class Article
{
    public $id;
    public $title;
    public $abstract;
    public $text;
    public $date;
    public $user;

    // Konstruktor
    public function __construct($id, $title, $abstract, $text, $date, $user_id)
    {
        $this->id = $id;
        $this->title = $title;
        $this->abstract = $abstract;
        $this->text = $text;
        $this->date = $date;
        $this->user = User::find($user_id); //naložimo podatke o uporabniku
    }

    // Metoda, ki iz baze vrne vse novice
    public static function all()
    {
        $db = Db::getInstance(); // pridobimo instanco baze
        $query = "SELECT * FROM articles;"; // pripravimo query
        $res = $db->query($query); // poženemo query
        $articles = array();
        while ($article = $res->fetch_object()) {
            // Za vsak rezultat iz baze ustvarimo objekt (kličemo konstuktor) in ga dodamo v array $articles
            array_push($articles, new Article($article->id, $article->title, $article->abstract, $article->text, $article->date, $article->user_id));
        }
        return $articles;
    }

    // Metoda, ki vrne eno novico z določenim id-jem iz baze
    public static function find($id)
    {
        $db = Db::getInstance();
        $id = mysqli_real_escape_string($db, $id);
        $query = "SELECT * FROM articles WHERE id = '$id';";
        $res = $db->query($query);
        if ($article = $res->fetch_object()) {
            return new Article($article->id, $article->title, $article->abstract, $article->text, $article->date, $article->user_id);
        }
        return null;
    }

    // Metoda za ustvarjanje nove novice
    public static function create($title, $abstract, $text, $user_id) {
        $db = Db::getInstance();
        $title = mysqli_real_escape_string($db, $title);
        $abstract = mysqli_real_escape_string($db, $abstract);
        $text = mysqli_real_escape_string($db, $text);
        $user_id = mysqli_real_escape_string($db, $user_id);
    
        $query = "INSERT INTO articles (title, abstract, text, user_id, date) VALUES ('$title', '$abstract', '$text', '$user_id', NOW())";
        echo "SQL Query: " . $query . "<br>"; //Dodaj to za debug
        $res = $db->query($query);
    
        if ($res) {
            // Vrni novo ustvarjeno novico (z ID-jem, ki ga je dodelila baza)
            $new_id = $db->insert_id;
            return self::find($new_id);
        } else {
            echo "Database Error: " . $db->error . "<br>"; //Preveri napako
            return null; // Napaka pri ustvarjanju
        }
    }

    // Metoda za iskanje novic glede na ID uporabnika
    public static function findByUserId($user_id) {
        $db = Db::getInstance();
        $user_id = intval($user_id); // Pretvori v integer za varnost
        $query = "SELECT * FROM articles WHERE user_id = '$user_id'";  // Uporabi prepared statements za varnost
        $res = $db->query($query);

        $articles = array();
        while ($article = $res->fetch_object()) {
            array_push($articles, new Article($article->id, $article->title, $article->abstract, $article->text, $article->date, $article->user_id));
        }
        return $articles;
    }
    
    // Metoda za posodabljanje obstoječe novice
    public function update($title, $abstract, $text) {
        $db = Db::getInstance();
        $id = mysqli_real_escape_string($db, $this->id);
        $title = mysqli_real_escape_string($db, $title);
        $abstract = mysqli_real_escape_string($db, $abstract);
        $text = mysqli_real_escape_string($db, $text);
    
        $query = "UPDATE articles SET title = '$title', abstract = '$abstract', text = '$text' WHERE id = '$id';";
        echo "SQL Query: " . $query . "<br>";  //Dodaj to za debug
    
        $res = $db->query($query);
    
        if ($res) {
            $this->title = $title;
            $this->abstract = $abstract;
            $this->text = $text;
            return true;
        } else {
            echo "Error: " . $db->error; //PREVERI NAPAKO
            return false;
        }
    }

    // Metoda za brisanje novice
    public function delete()
{
    $db = Db::getInstance();
    $id = mysqli_real_escape_string($db, $this->id);
    $query = "DELETE FROM articles WHERE id = '$id';";
    echo "Delete SQL Query: " . $query . "<br>"; // Dodaj to
    $res = $db->query($query);

    if (!$res) {
        echo "Error deleting article: " . $db->error . "<br>"; // Dodaj to
    }
    return (bool) $res;
    
}
}