<?php
//code sudah aman dan layak deploy

session_start();
require '../db.php'; // Menggunakan koneksi dari connection.php

function generateUniqueFilename($extension)
{
    return uniqid('img_', true) . '.' . $extension;
}

function uploadFile($file, $target_dir)
{
    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $unique_name = generateUniqueFilename($imageFileType);
    $target_file = $target_dir . $unique_name;
    $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        throw new Exception("File is not an image.");
    }

    if ($file["size"] > $maxFileSize) {
        throw new Exception("Sorry, your file is too large. Maximum file size is 3MB.");
    }

    $allowed_types = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_types)) {
        throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }

    if (!move_uploaded_file($file["tmp_name"], $target_file)) {
        throw new Exception("Sorry, there was an error uploading your file.");
    }

    return $unique_name;
}

function saveArticle($userId, $categoryId, $title, $content, $pdo, $unique_name)
{
    $sql = "INSERT INTO articles (user_id, category_id, title, content, image_url) VALUES (:user_id, :category_id, :title, :content, :image_url)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $userId);
    $stmt->bindValue(':category_id', $categoryId);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':content', $content);
    $stmt->bindValue(':image_url', $unique_name);

    if ($stmt->execute()) {
        echo "Artikel berhasil ditambahkan!";
    } else {
        throw new Exception("Error: " . implode(", ", $stmt->errorInfo()));
    }

    $stmt->closeCursor();
}

function getCategoryId($pdo, $categoryName)
{
    $sql = "SELECT category_id FROM categories WHERE name = :name";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $categoryName);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['category_id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES["articleImage"]) && isset($_POST['title']) && isset($_POST['category']) && isset($_POST['content']) && $_FILES["articleImage"]["error"] == 0) {
        echo "Processing file upload ...";
        echo $_FILES["articleImage"]["name"];
        $userId = $_SESSION['id'];
        $title = $_POST['title'];
        $category = getCategoryId($pdo, $_POST['category']);
        $content = $_POST['content'];
        try {
            $target_dir = "../../img/uploads/";
            $unique_name = uploadFile($_FILES["articleImage"], $target_dir);
            saveArticle($userId, $category, $title, $content, $pdo, $unique_name);
            echo "The file " . basename($_FILES["articleImage"]["name"]) . " has been uploaded, and the article was added to the database.";
            
            echo '<script>
                alert("Artikel gacormu udah dipost!");
                window.location.href = "../index.php?pageid=artikel";
            </script>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo '<script>
            alert("Bikin artikel dulu dong!");
            window.history.back();
        </script>';
    }
} else {
    echo '<script>
            alert("Method Post Error Bro, aksesnya gak lewat form ya?");
            window.history.back();
        </script>';

}

?>