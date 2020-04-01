<?php
include_once('session.php');
require_once('includes/header.php');
require_once('includes/nav.php');
include_once('comment.php');
include_once('post.php');

$comment = new Comment;
$post = new Post;
?>

<div class="container" style="padding-top: .3em;">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Details</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comment->getPendingComments() as $comments) { ?>
                <tr>
                    <td><?php echo $comments->name; ?></td>
                    <td><?php echo $comments->email; ?></td>
                    <td><?php echo $comments->subject; ?></td>
                    <!-- <?php foreach ($post->getPost() as $posts) {?>
                        <td><img src="images/<?php echo $posts->image; ?>" class="img-fluid" alt="blog image"></td>
                        <td><?php echo $posts->title; ?></td> 
                  <?php  }?> -->
                    <!-- <td><img src="images/<?php echo $posts->image; ?>" class="img-fluid" alt="blog image"></td> -->
                    <td><?php echo $comments->description; ?></td>
                    <td><?php echo date('D, d M Y h:i:s a',  strtotime($comments->created_at)); ?></td>
                    <td>
                        <form action="viewComment.php" method="post">
                            <input type="hidden" name="approveID" value="<?php echo $comments->id; ?>">
                            <button type="submit" name="apprvCmt" onclick="return confirm('Are you sure you want to approve?');" class="btn btn-outline-success btn-sm">Approve</button></a>
                        
                            <input type="hidden" name="delID" value="<?php echo $comments->id; ?>">
                            <button type="submit" name="delCmt" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>

                    </td>
                <?php } ?>

                <?php
                if (isset($_POST['apprvCmt'])) {
                    $result =  $comment->updateComments($_POST['approveID']);
                    if ($result == true) {
                        echo "Comment approved successfully.";
                        header("Location:viewCpmment.php");
                    }
                }

                if (isset($_POST['delCmt'])) {
                    $result = $comment->deleteComments($_POST['delID']);
                    if ($result == true) {
                        echo "Comment deleted Successfully.";
                        header("Location:viewCpmment.php");

                    }
                }

                ?>
                </tr>
        </tbody>
    </table>

</div>
<?php require_once('includes/footer.php');?>
