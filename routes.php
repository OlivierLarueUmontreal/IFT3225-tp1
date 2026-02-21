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
get('/home', VIEWS_PATH . '/Exercices/Exercices.php');

//Register and logins
get('/register', VIEWS_PATH . '/Connexions/Register.php');
get('/login', VIEWS_PATH . '/Connexions/Login.php');
get('/logout', function() {
    global $authenticationController;
    $authenticationController->logout();
});

//Exercice
//get('/exercice/$id', VIEWS_PATH . '/Exercices/Exercice.php');
get('/exercices', VIEWS_PATH . '/Exercices/Exercices.php');
get('/myexercices', function(){
    global $exerciceController;
    $exerciceController->fetchByCreatorId();
});
post('/exercice/add', function(){
    global $exerciceController;
    $exerciceController->add();
});
delete('/exercice/delete/$id', function($id){
    global $exerciceController;
    $exerciceController->delete($id);
});

post('/exercice/update/$id', function(){
    global $exerciceController;
    $exerciceController->update();
});

get('/my-account', function(){
    global $accountController;
    $accountController->showMyAccount();
});

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

//API
get('/api/exercices', function() {
    global $exerciceController;
    $exerciceController->fetchAll();
});


// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404', VIEWS_PATH . '/404.php');