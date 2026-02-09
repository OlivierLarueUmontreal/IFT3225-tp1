<?php

if(empty($_SESSION['username'])){
    echo "NOT LOG IN";
    header('Location: ' . makeUrl('login'));
    return;
}
$username = $_SESSION['username'];
$email = $_SESSION['email'];

echo "DISPLAY LIST OF EXERCICES <br>";

echo "User $username <br>\n";
echo "Email $email <br>\n";
