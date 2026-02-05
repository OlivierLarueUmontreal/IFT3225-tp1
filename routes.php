<?php
// Olivier Larue: SOURCE: https://github.com/phprouter/main/blob/main/routes.php FROM: https://phprouter.com/
// Olivier Larue: MODIFIER POUR MON UTILISATION
require_once __DIR__ . '/router.php';
//home
get('/', VIEWS_PATH . '/Home.php');

//Register and logins
get('/register', VIEWS_PATH . '/Connexions/Register.php');
get('/login', VIEWS_PATH . '/Connexions/Login.php');

//Exercice
get('/exercice/$id', VIEWS_PATH . '/Exercices/Exercice.php');
get('/exercices', VIEWS_PATH . '/Exercices/Exercices.php');

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404', VIEWS_PATH . '/404.php');