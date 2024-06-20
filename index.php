<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>BESIT - Apapun asal di Bekasi</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <?php require 'assets/php/navbar.php'; ?>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Selamat Datang si Bekasi Insight!</div>
            <div class="masthead-heading text-uppercase">Kunjungi Bekasi dari WEB!</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#Category">Sikatt!!</a>
        </div>
    </header>
    <style>
        .containerC {
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .col-md-4 {
            display: inline-block;
            vertical-align: top;
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
    </style>

    <?php include 'section_category.php'; ?>
    <?php
    require 'db_connection.php';

    $selectedCategory = isset($_GET['category_id']) ? intval($_GET['category_id']) : 1;

    $stmt = $pdo->prepare('SELECT * FROM articles WHERE category_id = ?');
    $stmt->execute([$selectedCategory]);
    $articles = $stmt->fetchAll();
    ?>
    <section class="page-section bg-light" id="articlecategory" >

        <?php include 'section_article.php'; ?>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.article-container').forEach(function (container) {
                container.addEventListener('click', function () {
                    var articleId = this.getAttribute('data-article-id');

                    fetch('fetch_article.php?article_id=' + articleId)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                document.getElementById('article-title').innerText = data.title;
                                document.getElementById('article-author').innerText = 'By ' + data.author;
                                document.getElementById('article-content').innerHTML = `
                                <img src="img/uploads/${data.image_url}" alt="${data.title}" class="img-fluid mb-3">
                                <p>${data.content}</p>
                            `;
                            }
                        });
                });
            });
        });
    </script>



    <!-- Content Field-->
    <section class="page-section" id="content">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase" id="article-title"></h2>
                <h3 class="section-subheading text-muted" id="article-author"></h3>
            </div>
            <div class="container" id="article-content">
                <!-- Content will be dynamically inserted here -->
            </div>
        </div>
    </section>

    <!-- Sponsor-->
    <?php include 'section_sponsor.php'; ?>
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <form id="contactForm">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div>
                            <br><br><br><br><br><br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
    <!-- Footer-->
    <?php include "footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>