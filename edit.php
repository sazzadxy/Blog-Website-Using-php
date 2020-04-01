<?php
require_once('includes/header.php');
require_once('includes/nav.php');
include_once('post.php');
//include_once('tag.php');

$post = new Post;
?>

<?php
if(isset($_POST['btnUpdate'])){
	$result = $post->updatePost($_POST['title'],$_POST['description'],$_GET['slug']);
	if($result==true){
		echo"<div class='text-center alert alert-success'>Post updated Successfully!</div>";
	}
}

?>

<div class="container">
    <div class="row justify-content-center">
     <?php foreach($post->getSinglePost($_GET['slug']) as $posts ) { ?>
        <div class="col-md-8">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">Edit Post</div>
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $posts->title; ?>">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="editor" cols="30" rows="10" class="form-control"><?php echo $posts->description; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="images/<?php echo $posts->image; ?>" style="width:15em;" alt="blog image" srcset="">
                        </div>

                        <div class="form-group">
                            <button type="submit" name="btnUpdate" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div> 
        <?php }  ?>
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