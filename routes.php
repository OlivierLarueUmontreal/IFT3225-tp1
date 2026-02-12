<?php
// Olivier Larue: SOURCE: https://github.com/phprouter/main/blob/main/routes.php FROM: https://phprouter.com/
// Olivier Larue: MODIFIER POUR MON UTILISATION
require_once __DIR__ . '/router.php';

get('/', function () {
    $loggedIn = isset($_SESSION['user_id']);
    if($loggedIn){
        header('Location: ' . makeUrl('home'));
    }else{
        header('Location: ' . makeUrl('login'));
    }
});

//home
get('/home', VIEWS_PATH . '/Home.php');

get('/app.js', VIEWS_PATH . '/app.js.php');

//Register and logins
get('/register', VIEWS_PATH . '/Connexions/Register.php');
get('/login', VIEWS_PATH . '/Connexions/Login.php');
get('/logout', function() {
    global $authenticationController;
    $authenticationController->logout();
});

//Exercice
get('/exercice/$id', VIEWS_PATH . '/Exercices/Exercice.php');
get('/exercices', VIEWS_PATH . '/Exercices/Exercices.php');


//TEST purposes only to test callback on router, maybe remove or admin only
get('/accounts' , function() {
    global $accountController;
    $accountController->showAll();
});

//Test de creation de compte sur post de /accounts
post('/accounts', function() {
    global $accountController;
    $accountController->register();
});

get('/authenticate', function() {
    global $authenticationController;
    $authenticationController->authenticate();
});

post('/authenticate', function() {
    global $authenticationController;
    $authenticationController->authenticate();
});

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404', VIEWS_PATH . '/404.php');