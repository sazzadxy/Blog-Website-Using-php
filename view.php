<?php
require_once('includes/header.php');
require_once('includes/nav.php');
include_once('post.php');
include_once('comment.php');

$post = new Post;
$comment = new Comment;

?>

<div class="container">
    <div class="row">
        <?php foreach ($post->getSinglePost($_GET['slug']) as $posts) { ?>
            <div class="card">
                <img class="card-img-top" src="images/<?php echo $posts->image; ?>" alt="post image....">
            </div>
            <div class="card-body">
                <h4 class="card-title"><?php echo $posts->title;  ?></h4>
                <h5 class="card-title">By <?php echo $posts->user;  ?></h5>
                <h6 class="card-title"><?php echo date('D, d M Y h:i:s a',  strtotime($posts->created_at)); ?></h6>
                <p class="card-text"><?php echo $posts->description; ?></p>

            </div>
        <?php  } ?>    
    </div>


    
    <h5>Comments (<?php echo $comment->countComments($_GET['slug']); ?>)</h5>
    <?php foreach ($comment->getCommentsBySlug($_GET['slug']) as $comments) { ?>
        <!-- <?php if ($comments->status != 0) { ?>        <?php } ?> -->
            <div class="media" style="background-color: aliceblue";>
                <div class="media-left media-top">
                    <img src="images/avatar.jpg" alt="Avatar" class="media-object" style="width: 5em;">
                    
                </div>
                <div class="media-body"> 
                    <p><strong><?php echo $comments->name; ?></strong>
                        at: <?php echo date('D, d M Y h:i a',  strtotime($comments->created_at)); ?><br>
                        <?php echo htmlspecialchars_decode($comments->description); ?>
                    </p>          
                   
                </div>
            </div>
 
    <?php  } ?>

    <h5>Leave a Comment</h5>
    <?php
    if (isset($_POST['btnComment'])) {
        $date = date("Y-m-d h:i:s", time() - 6*3600);
        $status = 0;
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['description'])) {
            $result = $comment->comment(strip_tags($_POST['name']),strip_tags($_POST['email']),strip_tags($_POST['subject']),strip_tags($_POST['description']),strip_tags($_GET['slug']),$date,$status);
            if ($result == true) {
                echo "Comment Added Successfully.";
            }
        } else {
            echo "Name, Email and Description fields are compulsory.";
        }
        
    }

    ?>
        <form action="" method="post">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" name="email" id="" class="form-control">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="name">Subject</label>
                    <input type="text" name="subject" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Description</label>
                    <textarea name="description" id="" cols="10" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="btnComment" class="btn btn-outline-success">Comment</button>
                </div>
            </div>
        </form>
    
</div>



<?php
require_once('includes/footer.php');
?>