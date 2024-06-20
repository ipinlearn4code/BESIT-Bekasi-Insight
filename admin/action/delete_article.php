<?php

//Done bang

function deleteImg($pdo, $articleId)
{
    $sql = "SELECT image_url FROM articles WHERE article_id = :article_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    $image_url = $result['image_url'];
    deleteImageFile("../../img/uploads/", $image_url);

}
function deleteImageFile($target_dir, $file)
{
    $target_file = $target_dir . $file;
    if (file_exists($target_file)) {
        unlink($target_file);
    }
}

if (isset($_GET['article_id'])) {
    require '../db.php'; // Adjust the path db as necessary
    $articleId = htmlspecialchars($_GET['article_id']);
    try {
        deleteImg($pdo, $articleId);
        $sql = "DELETE FROM articles WHERE article_id = :article_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: ../index.php?pageid=artikel");
            exit();
        } else {
            echo "Error deleting article.";
        }
    } catch (PDOException $e) {
        die("Gagal Hapus broo : " . $e);
    }

} else {
    echo "Article ID not provided.";
}
?>