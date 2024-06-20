<?php
//session_start();
require 'db.php'; // Adjust the path as necessary

$userId = $_SESSION['id'];
if ($_SESSION['privilege'] == 'Admin') {
    $sql = "SELECT * FROM articles 
        JOIN categories ON articles.category_id = categories.category_id";
} else
    $sql = "SELECT * FROM articles 
        JOIN categories ON articles.category_id = categories.category_id 
        WHERE user_id = $userId";
$stmt = $pdo->query($sql);

// Initialize an empty array to store fetched data
$articles = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $articles[] = $row;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Artikel</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Contennya disini -->
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <?php

                    echo '<h6 class="m-0 font-weight-bold text-primary">Daftar Artikel</h6>';
                    include 'custom/articletable.php';

                    ?>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->