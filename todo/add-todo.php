<?php
require '../php/dbconfig.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../todo/todo-app.php');
}
if (!isset($_POST['txt_todo'])) {
    header('location:../todo/todo-app.php');
}

$todo_task = $_POST['txt_todo'];

$conn = new mysqli($servername, $db_username, $db_password, $database);
if ($conn->connect_error) {
    die("Connection failed..." . $conn->connect_error);
}
$person_id=$_SESSION['person_id'];
$sql = "INSERT INTO `todo`(`person_id`, `todo_task`) VALUES ($person_id, '$todo_task')";
$result = $conn->query($sql);
$conn->close();
header('location:./todo-app.php');
?>