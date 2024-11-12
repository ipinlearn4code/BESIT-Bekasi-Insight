<?php
//session_start();
require 'db.php'; // Adjust the path as necessary

$userId = $_SESSION['id'];
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
                    <h6 class="m-0 font-weight-bold text-primary">Edit Artikel</h6>

                    <!-- done bang -->
                    <div class="card-body">
                        <?php
                        // Connect to the database
                        include 'db.php';

                        // Get the article ID from the URL parameter
                        $articleId = $_GET['article_id'];

                        // Fetch the article data from the database
                        $sql = "SELECT * FROM articles 
                            JOIN categories ON articles.category_id = categories.category_id
                            WHERE article_id = :article_id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
                        $stmt->execute();

                        // Check if the article was found
                        if ($stmt->rowCount() > 0) {
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $title = htmlspecialchars($row['title']);
                            $category = htmlspecialchars($row['name']); // Assuming 'name' is the category name
                            $content = htmlspecialchars($row['content']);
                            $image_url = htmlspecialchars($row['image_url']);
                        } else {
                            echo "Kayaknya salah di kode : Gak nemu id artikel.";
                        }


                        // Close the database connection
                        ?>

                        <form action="action/process_update_article.php" method="post" enctype="multipart/form-data" onsubmit="submitEditorContent()">
                            <div class="form-group">
                                <label for="articleTitle">Judul</label>
                                <input type="text" name="title" class="form-control" id="articleTitle"
                                    placeholder="Masukkan Judul Artikel" value="<?php echo $title; ?>">
                            </div>
                            <div class="form-group">
                                <label for="articleCategory">Kategori</label>
                                <select class="form-control" name="category" id="articleCategory">
                                    <option <?php if ($category == 'Livestyle')
                                        echo 'selected'; ?>>Lifestyle</option>
                                    <option <?php if ($category == 'Industry')
                                        echo 'selected'; ?>>Industry</option>
                                    <option <?php if ($category == 'Tourizm')
                                        echo 'selected'; ?>>Tourism</option>
                                    <option <?php if ($category == 'Environment')
                                        echo 'selected'; ?>>Environment</option>
                                    <option <?php if ($category == 'Comunity')
                                        echo 'selected'; ?>>Community</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="articleImage">Gambar</label>
                                <div>
                                    <input type="file" name="newimage_url" class="form-control-file" id="articleImage"
                                        style="display: none;">
                                    <label for="articleImage" class="btn btn-secondary">Click to edit image file</label>
                                    <label for="articleImage"><?php echo $image_url; ?></label>
                                    <input type="hidden" name="oldimage_url" value="<?php echo $image_url; ?>">
                                </div>

                                <label for="articleImage" style="color : blue">*Tidak perlu dirubah jika tidak mengubah
                                    gambar</label>

                            </div>

                            <div class="form-group">
                                <label for="articleContent">Konten</label>
                                <input type="hidden" name="content" id="editorContent">
                                <div id="editor">
                                    <p><?php
                                    // Logic untuk edit konten yang sudah ada
                                    if (isset($articleId)) {
                                        echo htmlspecialchars_decode($content);;
                                    } else {
                                        echo "Tulis konten disini";
                                    }
                                    ?></p>
                                </div>
                            </div>
                            <style>
                                .ck-editor__editable[role="textbox"] {
                                    /* Editing area */
                                    min-height: 200px;
                                }

                                .ck-content .image {
                                    /* Block images */
                                    max-width: 80%;
                                    margin: 20px auto;
                                }
                            </style>
                            <script>
                                let editorInstance;

                                ClassicEditor
                                    .create(document.querySelector('#editor'))
                                    .then(editor => {
                                        editorInstance = editor;
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });

                                function submitEditorContent() {
                                    if (editorInstance) {
                                        const content = editorInstance.getData();
                                        document.getElementById('editorContent').value = content;
                                    } else {
                                        console.error('Editor instance not ready.');
                                    }
                                }
                            </script>
                            <input type="hidden" name="article_id" value="<?php echo $articleId; ?>">
                            <button type="submit" class="btn btn-primary">Edit Artikel</button>
                        </form>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->