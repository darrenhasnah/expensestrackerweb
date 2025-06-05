<?php
session_start();
require_once '../vendor/autoload.php';
use App\Expense;

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new \Twig\Environment($loader);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $expense = new Expense();
    $expense->addExpense($_SESSION['user']['id'], $amount, $category, $description, $date);
    echo "Pengeluaran berhasil ditambahkan.";
}

echo $twig->render('dashboard.twig');
