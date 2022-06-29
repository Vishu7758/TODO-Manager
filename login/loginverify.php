<?php
    require_once '../php/dbconfig.php';
    require '../php/session_verify.php';
    $username = $_POST['txt_username'];
    $password = $_POST['txt_password'];

    $conn = new mysqli($servername, $db_username, $db_password,$database);
    if ($conn->connect_error) {
        die("Connection failed...".$conn->connect_error);
    }
    
    $sql = "SELECT * FROM PERSON WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result) {
        $row_count = mysqli_num_rows($result);
        if ($row_count == 1) {
            $row = $result->fetch_assoc();
            if ($row['password'] != $password) {
                $php_errormsg = "Wrong Password";
                header("Location:./Login.php?err_msg=$php_errormsg");
            }
            else {
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $row['name'];
                $_SESSION['person_id'] = $row['person_id'];
                $_SESSION['profile_pic'] = $row['profile_pic'];
                header("location:../todo/todo-app.php");
            }
        }
        else {
            $php_errormsg = "Wrong Password";
            header("Location:./Login.php?err_msg=$php_errormsg");
        }
    }
    else
    {
        $php_errormsg = "Wrong Username";
        header("Location:./Login.php?err_msg=$php_errormsg");
    }
?>