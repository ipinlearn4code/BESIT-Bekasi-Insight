<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bekasi Insight - Papan Lari</h1>
    </div>

    <!-- Content Row -->
    <div class="row">


        <!-- Total Artikel -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="card border-left-success shadow h-100 py-2" href="index.php?pageid=artikel">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Artikel Diposting</div>
                            <?php
                            // connection establishing
                            include ("db.php");

                            $userid = $_SESSION['id'];
                            // Query to get the total number of articles
                            try {
                                // Query to get the total number of articles for a specific user
                                $query = "SELECT COUNT(*) AS total_articles FROM articles WHERE user_id = :userid";
                                $stmt = $pdo->prepare($query);
                                $stmt->bindParam(':userid', $userid); // Bind the parameter here
                            
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                $totalArticles = $result['total_articles'];

                                // Output or use $totalArticles as needed
                                echo "Total Articles: " . $totalArticles;
                            } catch (PDOException $e) {
                                // Handle database errors if any
                                echo "Error: " . $e->getMessage();
                            }
                            ?>

                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalArticles; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="card border-left-info shadow h-100 py-2" href="index.php?pageid=penulis">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kelengkapan Profil
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div> -->

        <!-- Pending Requests Card Example -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Komentar Didapat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Content Row -->
    </div>

</div>
<!-- /.container-fluid -->