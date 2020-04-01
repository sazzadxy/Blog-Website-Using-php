<?php
require_once('includes/header.php');
require_once('includes/nav.php');
include_once('account.php');

?>
<?php
$user = new Account;

if (isset($_POST['btnLogin'])) {
    $user->login($_POST['username'],md5($_POST['password']));
    if (empty($_POST['username']) ||  empty($_POST['password'])) {
        echo "<div class='alert alert-danger' style='text-align:center'>ALL Fields are required!</div>";
}
}
?>

<form action="login.php" method="post">
<div class="container">
    <h4><i>Admin Login</i></h4>
    <div class="col-md-4">
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" name="username" id="" class="form-control" placeholder="username....">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="" class="form-control" placeholder="password....">
    </div>
    <div class="form-group">
        <button type="submit" name="btnLogin" class="btn btn-success">Submit</button>
    </div>
    </div> 
</div>
</form>
