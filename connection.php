<?php

//razred, ki skrbi za povezavo z bazo (Vzorec MVC zagovarja principe OOP)
class Db
{
    private static $instance = NULL;

    //Funkcija getInstance vrne povezavo z bazo. Ob prvem klicu ustvari povezavo in jo shrani v statični spremenljivki. Ob nadaljnjih klicih vrača povezavo iz spomina
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            // Poskusimo vzpostaviti povezavo
            self::$instance = mysqli_connect("127.0.0.1", "root", "", "news");

            // Preverimo, ali je povezava uspela
            if (!self::$instance) {
                // Če povezava ni uspela, nastavimo $instance na NULL in vržemo izjemo
                self::$instance = NULL;
                die("Povezava z bazo podatkov ni uspela: " . mysqli_connect_error());
            }

            self::$instance->set_charset("UTF8");
        }

        return self::$instance;
    }
}
?>