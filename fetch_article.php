<?php
require 'db_connection.php';

if (isset($_GET['article_id'])) {
    $articleId = intval($_GET['article_id']);

    $stmt = $pdo->prepare('SELECT articles.*, user.username AS author FROM articles JOIN user ON articles.user_id = user.id WHERE article_id = ?');
    $stmt->execute([$articleId]);
    $article = $stmt->fetch();

    if ($article) {
        echo json_encode([
            'title' => $article['title'],
            'author' => $article['author'],
            'content' => $article['content'],
            'image_url' => $article['image_url'],
            'datecreation' => $article['created_at']
        ]);
    } else {
        echo json_encode(['error' => 'Article not found']);
    }
} else {
    echo json_encode(['error' => 'No article ID provided']);
}
?>
