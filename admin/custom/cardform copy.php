<!-- done bang -->
<div class="card-body">
    <form action="action/process_article.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="articleTitle">Judul</label>
            <input type="text" name="title" class="form-control" id="articleTitle" placeholder="Masukkan Judul Artikel">
        </div>
        <div class="form-group">
            <label for="articleCategory">Kategori</label>
            <select class="form-control" name="category" id="articleCategory">
                <option>Livestyle</option>
                <option>Industry</option>
                <option>Tourizm</option>
                <option>Environment</option>
                <option>Comunity</option>
            </select>
        </div>
        <div class="form-group">
            <label for="articleImage">Gambar</label>
            <input type="file" name="articleImage" class="form-control-file" id="articleImage">
        </div>

        <div class="form-group">
            <label for="articleContent">Konten</label>
            <textarea class="form-control" name="content" id="articleContent" rows="5"
                placeholder="Masukkan Konten Artikel"></textarea>
        </div>
        <style>
            #containerck {
                width: 1000px;
                margin: 20px auto;
            }

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
        <div>
            <h1>Classic editor</h1>
            <div class="container" >
                <div id="editor">
                    <p>This is some sample content.</p>
                </div>

            </div>
            <script>
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Artikel</button>
    </form>
</div>