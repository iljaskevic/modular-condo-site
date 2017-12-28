<?php

?>

<form action="/user" method="POST" name="contact-us-form" id="contact-us-form" class="contact-us-form">

<?php
  if ($login_error) {
?>
    <div class="form-group col-lg-12">
      <div id="contact-us-error" class="alert alert-danger" role="alert">Incorrect Username or Password</div>
    </div>
<?php
  }
?>
  <div class="form-group col-md-6">
    <label for="uname">Username</label>
    <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter Username">
  </div>
  <div class="form-group col-md-6">
    <label for="pword">Password</label>
    <input type="password" class="form-control" id="pword" name="pword" placeholder="Enter Password">
  </div>
  <div class="form-group col-lg-12">
    <input type="submit" name="page_login" value="Login" class="btn btn-default btn-lg pull-right">
  </div>
</form>
