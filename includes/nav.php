
<!-- <?php session_start();?> -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav ml-auto">
      <a class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "index.php")? 'active':''?> "  href="index.php">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "add.php")? 'active':''?> " href="add.php">Add Post</a>
      <a class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "result.php")? 'active':''?>  " href="result.php">Dashboard</a>
      
      <?php if (!empty($_SESSION['username'])) { ?>
        <a class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "logout.php")? 'active':''?> " href="logout.php">Logout</a>
     <?php } else { ?>
       <a class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "login.php")? 'active':''?> " href="login.php">Login</a>
    <?php }?>

   
      
    </div>
  </div>
</nav>