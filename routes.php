<?php
/*
  Usmerjevalnik (router) skrbi za obravnavo HTTP zahtev. Glede na zahtevo, 
  pokliče ustrezno akcijo v zahtevanem controllerju.
*/

{
  // Vključimo kodo controllerja in modela (pazimo na poimenovanje datotek)
  require_once('controllers/' . $controller . '_controller.php');
  if (file_exists('models/' . $controller . '.php')) {
    include_once('models/' . $controller . '.php');
  }

  // Ustvarimo kontroler
  $o = $controller . "_controller"; //generiramo ime razreda controllerja
  $controller = new $o; //ustvarimo instanco razreda (ime razreda je string spremenljivka)

  //pokličemo akcijo na kontrolerju (ime funkcije je string spremenljivka)
  $controller->{$action}();
}

// Seznam vseh dovoljenih controllerjev in njihovih akcij. Z njegovo pomočjo lahko 
// definiramo tudi pravice (ustrezno zmanjšamo nabor akcij pod določenimi pogoji)
$controllers = array(
  'pages' => ['error'],
  'users' => ['create', 'store'],
  'auth' => ['login', 'authenticate'],
  'articles' => ['index', 'show', 'list', 'edit','create']
);


