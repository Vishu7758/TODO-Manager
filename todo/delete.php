<?php
    require '../php/session_verify.php';
    require '../php/dbconfig.php';
    if (!isset($_GET['todo-id'])) {
        header('location:./todo-app.php');
    }
    $todo_id = $_GET['todo-id'];

    $conn = new mysqli($servername, $db_username, $db_password, $database);
    if ($conn->connect_error) {
        die("Connection failed..." . $conn->connect_error);
    }
    $person_id=$_SESSION['person_id'];
    $sql = "DELETE FROM todo where todo.todo_id = $todo_id and todo.person_id = $person_id";
    $result = $conn->query($sql);
    $conn->close();
    header('location:./todo-app.php');
?>