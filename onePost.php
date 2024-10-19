
<?php

    session_start();

    require_once 'common/checkAuth.php';
    require_once 'common/connect.php';

    $categories = getCategories();

    $postId = $_GET['post_id'] ?? null;

    if($postId)
        $post = getOnePost($postId);
    
    // $avg = getRating($postId); // $avg is an array



 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Homepage</title>
        <?php require_once 'common/inhead.php'; ?>  
        <style>
            .home_task {
                display: flex;
                align-items: center;
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <?php require_once 'common/nav.php' ?>
        
        <!-- Page content-->
        <div class="container py-4">
            <div class="row justify-content-center">
                <!-- Blog entries-->
                <div class="col-lg-8 ">
                    <!-- Post content-->
                    <article class="">
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?= $post['title'] ?></h1>
                            <section class="my-5">
                                <?= $post['content'] ?>
                            </section>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4">
                            <video width="500px" controls="controls">
                                <source src="http://localhost/zama/session/blogkz/images/posts/<?=$post['video'];?>" type="video/mp4">
                            </video>
                            <div class="text-muted fst-italic mb-2"><?= $post['created_at'] ?></div>
                        </figure>
                        <!-- Post content-->
                        <div class="home_task">
                            <a href="http://localhost/zama/session/blogkz/test/<?=$post['test'];?>" class="btn btn-primary mb-3 mx-3" download="" id="downloadLink">
                                Үй жұмысы!
                            </a> 
                        </div>
                    </article>

                    <!-- <form action="rate.php" method="post">
                        <input type="hidden" name="post_id" value="<?=$post['id']?>">
                        <select class="form-select" name="rating">
                            <option value="1">very bad (1)</option>
                            <option value="2">bad (2)</option>
                            <option value="3">ok (3)</option>
                            <option value="4">good (4)</option>
                            <option value="5">very good (5)</option>
                        </select>
                        <button type="submit" class="btn btn-info my-3">Rate</button>
                    </form> -->

                    <!-- Comments section-->
                    <!--  -->
             
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark ">
            <!-- <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div> -->
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>