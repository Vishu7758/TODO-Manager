<?php

$target_dir = "../profile_pic/";
$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
$uploadOk = 1;
$warning = '';
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
if ($check !== false) {
    $uploadOk = 1;
} else {
    $warning = "File is not an image.";
    $uploadOk = 0;
}


// Check if file already exists
if (file_exists($target_file)) {
    $warning = "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["profile_pic"]["size"] > 500000) {
    $warning = "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    $warning = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $warning = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        $warning = "The file " . htmlspecialchars(basename($_FILES["profile_pic"]["name"])) . " has been uploaded.";
    } else {
        $warning = "Sorry, there was an error uploading your file.";
    }
}
