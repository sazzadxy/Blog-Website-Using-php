<?php
include_once('./db/DB.php');
$db = new DB;

 function uploadImage()
{
     $imageName = $_FILES['image']['name'];  //name filed of image input field name="image"
     $imageTmp = $_FILES['image']['tmp_name'];

     $allowed = array('png','jpg','jpeg', 'gif');
     $ext = pathinfo($imageName,PATHINFO_EXTENSION);

     if (in_array($ext,$allowed)) {
         move_uploaded_file($imageTmp, "images/".$imageName);
     }else {
         echo "<div class='text-center alert alert-info' role='alert'>Only png, jpg, jpeg and gif image formats are allowed!</div>";
     }

     return $imageName;

}

// a new title
// a-new-title
function createSlug($string){
$slug = preg_replace('/[^A-Za-z0-9]+/','-',$string);
return $slug;
}





?>

