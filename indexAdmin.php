
<?php

    session_start();

    require_once 'common/checkAdmin.php';
    require_once 'common/connect.php';

    $categories = getCategories();

    $search = $_POST['search'] ?? '';

    if($search){
        $posts = searchPosts($search);
    }
    else {
        $catId = $_GET['cat_id'] ?? null;

        if($catId)
            $posts = getPosts($catId);
        else
            $posts = getPosts();
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Homepage</title>
        <?php require_once 'common/inhead.php'; ?>
        <style>
            .card-body form {
                display: inline;
            }
        </style> 
    </head>
    <body>
        <?php require_once 'common/navAdmin.php' ?>
        
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6 mx-auto">        
                        <?php foreach($posts as $post): ?> 
                            <div class="card mb-4">
                                <video width="350px" controls="controls" class="mx-auto mt-3">
                                    <source src="http://localhost/zama/session/blogkz/images/posts/<?=$post['video'];?>" type="video/mp4">
                                </video>
                                <div class="card-body">
                                    <div class="small text-muted"><?= $post['created_at'] ?></div>
                                    <h2 class="card-title h4"><?= $post['title'] ?></h2>
                                    <a class="btn btn-primary" href="onePost.php?post_id=<?= $post['id'] ?>">Read →</a>
                                    <?php if($post['user_id'] == $user['id']): ?>
                                    <a class="btn btn-primary" href="editPostForm.php?post_id=<?= $post['id'] ?>">Edit →</a>
                                    <form onsubmit="return confirm('Really want to delete?')" action="deletePost.php" method="post">
                                        <input type="hidden" name="post_id" value="<?= $post['id']?>">
                                        <button class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php require_once 'common/aside.php' ?>
            </div>
        </div>
        <footer class="py-5 bg-dark">
            
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
