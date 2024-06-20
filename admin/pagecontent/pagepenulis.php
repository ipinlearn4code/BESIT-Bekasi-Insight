<style>
    .profile-img {
        max-width: 50%;
        height: auto;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Biodata Penulis</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Contennya disini -->
        <?php
        require 'db.php'; // Adjust the path as necessary
        
        // Fetch user profile from the database
        $userId = $_SESSION['id'];
        $sql = "SELECT username, email, bio, created_at, ava_img_url FROM user WHERE id = :userid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $uProf = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>



        <!-- Contennya disini -->
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="card-body">


                    </div>
                    <h4><?php echo htmlspecialchars($uProf['username']); ?>
                    </h4>
                    <br>
                    <div class="d-sm-flex">
                        <div class="col-lg-3">
                            <img src="../img/ava/<?php echo ($uProf['ava_img_url']) ?>" alt="Profile Picture"
                                class="profile-img">
                        </div>
                        <div class="col-lg-4">
                            <br>
                            <p><span style="font-weight: bold;">Bergabung Sejak</span></p>
                            <p></p><span style="font-weight: bold;">Email</span></p>
                            <p><span style="font-weight: bold;">Bio</span></p>
                        </div>
                        <div class="col-lg-12">
                            <br>
                            <p><?php echo htmlspecialchars($uProf['created_at']); ?></p>
                            <p><?php echo htmlspecialchars($uProf['email']); ?></p>
                            <p><?php echo htmlspecialchars($uProf['bio']); ?></p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->