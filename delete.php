<?php
require_once('includes/header.php');
require_once('includes/nav.php');
include_once('post.php');

$post = new Post;
$post->deletePost($_GET['slug']);
header("Location:result.php");

?>