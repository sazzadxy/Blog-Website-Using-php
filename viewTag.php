<?php
require_once('session.php');
require_once('includes/header.php');
require_once('includes/nav.php');
include_once('db/DB.php');
include_once('tag.php');

$db = new DB;
$tag = new Tag;
?>

<?php
if (isset($_POST['btnAdd'])) {
    $title = strip_tags($_POST['title']);
    $result = $tag->addTags($title);
    
    if (empty($title)) {
        echo "<div class='text-center alert alert-danger'>Field can't empty!</div>";
    } else {
        if ($result == true) {
            echo "<div class='text-center alert alert-success'>Tags added Successfully!</div>";
        }
    }
}


if (isset($_POST['edtTitle'])) {
    $result = $tag->updateTags($_POST['edttitle'], $_POST['editID']);
    if ($result == true) {
        echo "<div class='text-center alert alert-success'>Tags updated Successfully!</div>";
    }
}

if (isset($_POST['delTitle'])) {
    $result = $tag->deleteTags($_POST['delID']);
    if ($result == true) {
        echo "<div class='text-center alert alert-success'>Tags deleted Successfully!</div>";
    }
}

?>

<div class="container">
    <div class="row justify-content">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">Avaliable Tags</div>
                <div class="card-body">
                    <?php
                    foreach ($tag->getAllTags() as $tags) { ?>
                        <p class="center" style="margin-top: .1em;"><em><?php echo html_entity_decode($tags->tag);  ?></em></p>
                    <?php } ?>
                </div>
            </div>

        </div>


        <div class="col-md-4">

            <form action="viewTag.php" method="POST">
                <div class="card">
                    <div class="card-header">Add Tags</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="btnAdd" class="btn btn-outline-primary btn-sm">Add Tag</button>
                        </div>
                    </div>
                </div>

            </form>



        </div>


        <?php foreach ($tag->getAllTags() as $tags) { ?>
            <div class="col-md-4" style="margin-bottom:.5em;">
                <form action="viewTag.php" method="POST">
                    <div class="card">
                        <div class="card-header">Edit Tags</div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="edttitle" class="form-control" value="<?php echo $tags->tag; ?>">
                            </div>

                            <input type="hidden" name="editID" value="<?php echo $tags->id; ?>">
                            <button type="submit" name="edtTitle" onclick="return confirm('Are you sure you want to update?');" class="btn btn-outline-success btn-sm">Update</button></a>

                            <input type="hidden" name="delID" value="<?php echo $tags->id; ?>">
                            <button type="submit" name="delTitle" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-outline-danger btn-sm">Delete</button>

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