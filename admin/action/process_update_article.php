<?php
session_start();
require '../db.php'; // Assuming this file contains your database connection

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
        throw new Exception("Sorry, your file is too large. Maximum file size is 2MB.");
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

function saveArticle($userId, $articleId, $categoryId, $title, $content, $image_url, $pdo)
{
    $sql = "UPDATE articles SET user_id = :user_id, category_id = :category_id, title = :title, content = :content, image_url = :image_url WHERE article_id = :article_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $userId);
    $stmt->bindValue(':category_id', $categoryId);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':content', $content);
    $stmt->bindValue(':image_url', $image_url);
    $stmt->bindValue(':article_id', $articleId);

    if ($stmt->execute()) {
        echo "Artikel berhasil diupdate!";
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

function deleteImageFile($target_dir, $file)
{
    $target_file = $target_dir . $file;
    if (file_exists($target_file)) {
        unlink($target_file);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['article_id'], $_POST['title'], $_POST['category'], $_POST['content'])) {
        $articleId = $_POST['article_id'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $content = $_POST['content'];
        $userId = $_SESSION['id'];
        $target_dir = "../../img/uploads/";

        try {
            if (!empty($_FILES["newimage_url"]["name"])) {
                $unique_name = uploadFile($_FILES["newimage_url"], $target_dir);
                $oldImage = $_POST['oldimage_url'];
                deleteImageFile($target_dir, $oldImage);
            } else {
                $unique_name = $_POST['oldimage_url'];
            }

            $categoryId = getCategoryId($pdo, $category);
            saveArticle($userId, $articleId, $categoryId, $title, $content, $unique_name, $pdo);

            echo '<script>
                alert("Artikel berhasil diupdate!");
                window.location.href = "../index.php?pageid=artikel";
            </script>';
            exit();
        } catch (Exception $e) {
            echo '<script>
                alert("Error: ' . $e->getMessage() . '");
                window.history.back();
            </script>';
            exit();
        }
    } else {
        echo '<script>
            alert("Semua field harus diisi!");
            window.history.back();
        </script>';
        exit();
    }
} else {
    echo '<script>
            alert("Metode tidak diizinkan!");
            window.history.back();
        </script>';
    exit();
}
?>
