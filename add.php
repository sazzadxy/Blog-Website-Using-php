<?php
include_once('session.php');
require_once('includes/header.php');
require_once('includes/nav.php');
require_once('functions/functions.php');
require_once('post.php');
require_once('db/DB.php');
require_once('tag.php');

$post = new Post;
$db = new DB;
$tag = new Tag;

if (isset($_POST['btnSubmit'])) {
    
    $title = strip_tags( $_POST['title']);
    $des = $_POST['description'];
    $date = date("Y-m-d h:i:s", time() - 6*3600);
    $slug = createSlug($title);
    $image = uploadImage();
    $user = $_SESSION['username'];



    $checkSlug = $db->query("SELECT * FROM posts WHERE slug = :slug");
    $checkSlug = $db->bind(':slug',$slug);
    $checkSlug = $db->single();
    $result = $db->rowCount($checkSlug);

    if ($result>0) {
        foreach ($checkSlug as $cslug ) {
            $newSlug = $slug.uniqid();
        }
        $record = $post->addPost($title, $des, $image, $date, $newSlug, $user);
    } else {
        $record = $post->addPost($title, $des, $image, $date, $slug, $user);
    }

    
    if (empty($title) || empty($des) || empty($image)) {
        echo "<div class='text-center alert alert-danger' role='alert'>Every Field Is Required!</div>";
    } else {
        if ($record == True) { 
            echo "<div class='text-center alert alert-success' role='alert'>Post Added Successfully!</div>";
        }
    }
}

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="add.php" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">Add Post</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="editor" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                         
                        <label for="tags"><b>Choose Tags:</b>&nbsp;</label>
                        <div class="form-check form-check-inline">
                            
                            
                            <div class="col-md-12">
                            <?php 
                            foreach ($tag->getAllTags() as $tags) { ?>     
                            <input type="checkbox" name="tags[]" class="form-check-input" value="<?php echo $tags->id;?>">
                            <?php echo $tags->tag; ?>
                            <?php }?> 
                            </div>
                           
                        </div>

                        <div class="form-group">
                            <button type="submit" name="btnSubmit" class="btn btn-primary" style="margin-top: 1em;">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>


<?php
require_once('includes/footer.php');
?>