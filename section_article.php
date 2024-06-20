<?php
require 'db_connection.php';

$selectedCategory = isset($_GET['category_id']) ? intval($_GET['category_id']) : 1;

$stmt = $pdo->prepare('SELECT * FROM categories WHERE category_id = ?');
$stmt->execute([$selectedCategory]);
$category = $stmt->fetch();

$categoryName = $category['name'];
$categoryDescription = $category['description'];

$stmt = $pdo->prepare('SELECT * FROM articles WHERE category_id = ?');
$stmt->execute([$selectedCategory]);
$articles = $stmt->fetchAll();

?>
<style>
    .fixed-size-container {
        height: 250px;
        /* Fixed height for the container */
        width: 100%;
        /* Full width */
        overflow: hidden;
        /* Hide overflow content */
        position: relative;
        /* Relative positioning for internal alignment */
    }

    .fixed-size-img-container {
        height: 250px;
        /* Fixed height */
        width: 100%;
        /* Full width */
        overflow: hidden;
        /* Hide overflow content */
        position: relative;
        /* Relative positioning */
    }

    .fixed-size-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        /* Cover the container */
        display: block;
        /* Block display */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* Center the image */
    }
</style>

<div class="container">
    <div class="text-center">
        <h2 class="section-heading text-uppercase"><?php echo htmlspecialchars($categoryName); ?></h2>
        <h3 class="section-subheading text-muted"><?php echo htmlspecialchars($categoryDescription); ?></h3>
    </div>
    <div class="row">
        <?php
        foreach ($articles as $article) {
            echo '<div class="col-lg-4 col-sm-6 mb-4 article-container" data-article-id="' . $article['article_id'] . '">';
            echo '<div class="portfolio-item">';
            echo '<a class="portfolio-link" href="#content">';
            echo '<div class="portfolio-hover">';
            echo '<div class="portfolio-hover-content"></div>';
            echo '</div>';
            echo '<div class="container">';
            echo '<div class="fixed-size-img-container">';
            echo '<img class="img-fluid fixed-size-img" src="img/uploads/' . htmlspecialchars($article['image_url']) . '" alt="..." />';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '<div class="portfolio-caption fixed-size-container">';
            echo '<div class="portfolio-caption-heading">' . htmlspecialchars($article['title']) . '</div>';
            echo '<div class="portfolio-caption-subheading text-muted">' . htmlspecialchars(strip_tags(substr($article['content'], 0, 100))) . '...</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>

    </div>
</div>