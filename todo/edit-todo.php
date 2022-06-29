<?php
    require '../php/session_verify.php';
    require '../php/dbconfig.php';

    $todo_id = $_POST['todo_id'];
    $todo_task = $_POST['txt_todo'];

    $conn = new mysqli($servername, $db_username, $db_password, $database);
    if ($conn->connect_error) {
        die("Connection failed..." . $conn->connect_error);
    }
    $person_id=$_SESSION['person_id'];
    $sql = "UPDATE `todo` SET `todo_task`='$todo_task' WHERE todo.todo_id=$todo_id";
    $result = $conn->query($sql);
    $conn->close();
    header('location:./todo-app.php');
?>