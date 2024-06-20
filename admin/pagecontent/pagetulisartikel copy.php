<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Artikel</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Form Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Card -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tulis artikel anda!
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="process_article.php" method="post">
                                        <div class="form-group">
                                            <label for="articleTitle">Judul</label>
                                            <input type="text" name="articleTitle" class="form-control" id="articleTitle"
                                                placeholder="Masukkan Judul Artikel">
                                        </div>
                                        <div class="form-group">
                                            <label for="articleCategory">category</label>
                                            <select class="form-control" name="articleCategory" id="articleCategory">
                                                <option>Pemrograman</option>
                                                <option>Desain</option>
                                                <option>Teknologi</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="articleImage">Gambar</label>
                                            <input type="file" name="articleImage" class="form-control-file" id="articleImage">
                                        </div>
                                        <div class="form-group">
                                            <label for="articleContent">Konten</label>
                                            <textarea class="form-control" name="articleContent" id="articleContent" rows="5"
                                                placeholder="Masukkan Konten Artikel"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tambah Artikel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                /.container-fluid

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->