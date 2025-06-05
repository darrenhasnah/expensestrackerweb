<?php
require_once '../vendor/autoload.php';
use App\User;

session_start();

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new \Twig\Environment($loader);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    $user = new User();

    if ($action == 'register') {
     
        $username = $_POST['username'];
        $password = $_POST['password'];

     
        if ($user->findByUsername($username)) {
            echo "Username sudah terdaftar.";
        } else {
            $user->create($username, $password);
            echo "Akun berhasil dibuat.";
        }
    } elseif ($action == 'login') {
     
        $username = $_POST['username'];
        $password = $_POST['password'];

        $loggedInUser = $user->login($username, $password);
        if ($loggedInUser) {
            $_SESSION['user'] = $loggedInUser;
        } else {
            echo "Username atau password salah.";
        }
    }
}

echo $twig->render('home.twig');
