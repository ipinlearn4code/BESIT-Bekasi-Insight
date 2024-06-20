<?php

include 'auth.php';

?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Bekasi Insight - Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #content {
            min-height: 200px;
            border: 1px solid #ced4da;
            padding: 10px;
            background-color: white;
        }
    </style>

    <!-- ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- sidebar -->
        <?php include 'custom/sidebar.php'; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require 'custom/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?php
                if (isset($_GET['pageid'])) {
                    $pageid = $_GET['pageid'];
                    if ($pageid == 'penulis') {
                        include 'pagecontent/pagepenulis.php';
                    } else if ($pageid == 'kategori') {
                        include 'pagecontent/pagekategori.php';
                    } else if ($pageid == 'artikel') {
                        include 'pagecontent/pageartikel.php';
                    } else if ($pageid == 'tulisartikel') {
                        include 'pagecontent/pagetulisartikel.php';
                    } else if ($pageid == 'editartikel') {
                        include 'pagecontent/pageeditartikel.php';
                    } else if ($pageid == 'editpenulis') {
                        include 'pagecontent/pageeditpenulis.php';
                    } else if ($pageid == 'editkategori') {
                        include 'pagecontent/pageeditkategori.php';
                    } else if ($pageid == 'hapusartikel') {
                        include 'pagecontent/pagehapusartikel.php';
                    } else if ($pageid == 'hapuskategori') {
                        include 'pagecontent/pagehapuskategori.php';
                    } else if ($pageid == 'hapuspenulis') {
                        include 'pagecontent/pagehapuspenulis.php';
                    } else if ($pageid == 'logout') {
                        include 'logout.php';
                    }
                } else {
                    include 'pagecontent/pageindex.php';
                }
                ?>

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
</body>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/decoupled-document/ckeditor.js"></script>

</html>