<?php
include_once('session.php');
require_once('includes/header.php');
require_once('includes/nav.php');
include_once('post.php');

$post = new Post;

?>

<div class="container">
    <h2>All Posts</h2>
    <p>
    <a style="text-decoration:none;" href="viewComment.php"><button class="btn btn-outline-info btn-sm mx-1"  style="float: right;">All Comments</button></a>
    <a style="text-decoration:none;" href="viewTag.php"><button class="btn btn-outline-info btn-sm mx-1"  style="float: right;">Tags</button></a>
    </p>
    
    <?php
         if (!empty($_SESSION['username'])) {
            echo "<p class='h6'>Welcome, {$_SESSION['username']}</p>";
         } else {
             echo "You're not logged in!";
         }

    ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead> 
        <tbody>
            <?php foreach ($post->getPost() as $posts) { ?>
                <tr>
                <td><?php echo $posts->title;?></td>
                <td><img src="images/<?php echo $posts->image; ?>" class="img-fluid" alt="blog image"></td>
                <td><?php echo substr($posts->description,0,20) ;?></td>
                <td><?php echo date('D, d M Y h:i:s a',  strtotime($posts->created_at)); ?></td>
                <td>
                    <a href="view.php?slug=<?php echo $posts->slug;?>"><button type="submit" class="btn btn-outline-success btn-sm">View</button></a>
                <?php if($_SESSION['username'] == $posts->user) : ?>
                    <a href="edit.php?slug=<?php echo $posts->slug;?>"><button type="submit" class="btn btn-outline-primary btn-sm">Edit</button></a>
                    <a href="delete.php?slug=<?php echo $posts->slug;?>" onclick="return confirm('Are you sure you want to delete?');"><button type="submit" class="btn btn-outline-danger btn-sm">Delete</button></a>
                <?php endif; ?>
                </td>
            </tr>
            <?php }?>

        </tbody>       
    </table>

    <?php 
            
            
            $limit = 3;
            $db->query("SELECT count(id) AS total FROM posts");
            $row = $db->resultset();
            $totalRecords = $row[0]->total;
            $totlaPages = ceil($totalRecords/$limit);
            $pageLink = "<ul class='pagination justify-content-center'>";

            if(!isset($_GET['tag'])){
                //if there is "tag" we don't show pagination
                if (!isset($_GET['page'])) {
                    //is there is no "page" we set $_GET=1 
                    $_GET['page']=1;
                }
            }

            $page = $_GET['page'];    
            if ($page>1) {
                $pageLink.="<a class='page-link'href='result.php?page=1'>First</a>";
                $pageLink.="<a class='page-link'href='result.php?page=".($page-1)."'><<<</a>";
            }
            
            for ($i=1; $i <= $totlaPages; $i++) { 
                $pageLink.="<a class='page-link' href='result.php?page=".$i."'>".$i."</a>";
            }

            if ($page<=$totlaPages) {
                $pageLink.="<a class='page-link'href='result.php?page=".($page+1)."'>>>></a>";
                $pageLink.="<a class='page-link'href='result.php?page=".$totlaPages."'>Last</a>";
            }

            echo $pageLink."</ul>"; 
    ?>

</div>

<?php require_once('includes/footer.php'); ?>