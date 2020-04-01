<?php
require_once('includes/header.php');
require_once('includes/nav.php');
include_once('post.php');
include_once('tag.php');
include_once('account.php');
include_once('db/DB.php');

$post = new Post;
$tag = new Tag;
$db = new DB;
?>


<div class="container">
    <div class="row">

        <div class="col-md-8">
            <?php if (isset($_GET['keyword'])) {
                echo '<i>Search For :</i> ' . '<i>' . $_GET['keyword'] . '</i>';
            }  ?>
            <?php foreach ($post->getPost() as $posts) { ?>
                <div class="media">
                    <div class="media-left media-top">
                        <!-- <a href="view.php?slug=<?php echo $posts->slug; ?>" style="color:black;text-decoration: none;"> -->
                        <img src="images/<?php echo $posts->image; ?>" alt="blog image...." class="media-object" style="width:15em;">
                        <p>Author : <?php echo $posts->user; ?><br>
                           At : <?php echo date('D, d M Y h:i a',  strtotime($posts->created_at)); ?>
                        </p>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="view.php?slug=<?php echo $posts->slug; ?>" style="text-decoration: none;"><?php echo $posts->title; ?></a></h4>
                        <?php echo htmlspecialchars_decode(substr($posts->description, 0, 200)); ?>
                    </div>
                </div>
            <?php } ?>
            
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
                $pageLink.="<a class='page-link'href='index.php?page=1'>First</a>";
                $pageLink.="<a class='page-link'href='index.php?page=".($page-1)."'><<<</a>";
            }
            
            for ($i=1; $i <= $totlaPages; $i++) { 
                $pageLink.="<a class='page-link' href='index.php?page=".$i."'>".$i."</a>";
            }

            if ($page<=$totlaPages) {
                $pageLink.="<a class='page-link'href='index.php?page=".($page+1)."'>>>></a>";
                $pageLink.="<a class='page-link'href='index.php?page=".$totlaPages."'>Last</a>";
            }

            echo $pageLink."</ul>"; 
            ?>


        </div>

        <div class="col-md-4">
            <h4><i>Browse By Tags</i></h4>
            <p>
                <?php
                foreach ($tag->getAllTags() as $tags) { ?>
                    <a href="index.php?tags=<?php echo $tags->tag; ?>" style="text-decoration: none;">
                        <button type="button" class="btn btn-outline-warning btn-sm" style="margin-top: 10px;"><?php echo $tags->tag; ?></button>
                    </a>
                <?php }
                ?>
            </p>

            <p>
                <h4><i>Search Posts</i></h4>
                <form action="" method="GET">
                    <input type="text" name="keyword" class="form-control form-control-sm mr-3 w-75" value="" placeholder="Type Here...">
                    <button type="submit" class="btn btn-outline-info btn-sm" style="margin-top: 5px;">
                        Search
                    </button>
                </form>
            </p>

            <h4><i>Popular Posts</i></h4>

            <?php foreach ($post->getPopularPosts() as $posts) { ?>
                <p>
                    <a href="view.php?slug=<?php echo $posts->slug; ?>" style="color:black; border-bottom:1px dashed green; text-decoration:none"><?php echo $posts->title; ?></a>
                </p>

            <?php  } ?>


        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>