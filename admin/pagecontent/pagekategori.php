<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
    </div>

    <!-- Content Row -->
        <?php
        require 'db.php'; // Adjust the path as necessary
        
        // Fetch categories from the database
        $sql = "SELECT category_id, name, description FROM Categories";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>


        <!-- Contennya disini -->
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <?php foreach ($categories as $category): ?>
                        <div>
                            <h4><?php echo htmlspecialchars($category['name']); ?>
                            </h4>
                            <p><?php echo htmlspecialchars($category['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->