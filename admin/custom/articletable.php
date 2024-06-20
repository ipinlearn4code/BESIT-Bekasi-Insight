<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Content</th>
                    <th>Image URL</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?php echo $article['title']; ?></td>
                        <td><?php echo $article['name']; ?></td>
                        <!-- Assuming 'name' is the column name in the categories table -->
                        <td><?php echo substr($article['content'], 0, 300); ?> ...</td>
                        <td><?php echo $article['image_url']; ?></td>
                        <td>
                            <a href="index.php?pageid=editartikel&article_id=<?php echo $article['article_id']; ?>"
                                class="btn btn-primary">Edit</a>

                            <a href="action/delete_article.php?article_id=<?php echo $article['article_id']; ?>"
                                class="btn btn-danger" onclick="return confirm('Yakin dihapus bro?')">Delete</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>