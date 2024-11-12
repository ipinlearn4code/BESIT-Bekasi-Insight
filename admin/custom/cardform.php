<div class="card-body">
    <form action="action/process_article.php" method="post" enctype="multipart/form-data" onsubmit="submitEditorContent()">
        <div class="form-group">
            <label for="articleTitle">Judul</label>
            <input type="text" name="title" class="form-control" id="articleTitle" placeholder="Masukkan Judul Artikel">
        </div>
        <div class="form-group">
            <label for="articleCategory">Kategori</label>
            <select class="form-control" name="category" id="articleCategory">
                <option>Lifestyle</option>
                <option>Industry</option>
                <option>Tourism</option>
                <option>Environment</option>
                <option>Community</option>
            </select>
        </div>
        <div class="form-group">
            <label for="articleImage">Gambar</label>
            <input type="file" name="articleImage" class="form-control-file" id="articleImage">
        </div>
        <div class="form-group">
            <label for="articleContent">Konten</label>
            <input type="hidden" name="content" id="editorContent">
            <div id="editor">
                <p><?php
                // Logic untuk edit konten yang sudah ada
                if (0 == 1) {
                    echo "Value konten lama";
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
        <button type="submit" class="btn btn-primary">Tambah Artikel</button>
    </form>
</div>
