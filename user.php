<?php
require_once 'vendor/autoload.php';
$config = require_once('config.php');
$contentfulConfig = $config['contentful'];

$client = new \Contentful\Delivery\Client($contentfulConfig['accessKey'], $contentfulConfig['spaceId']);
$siteId = $contentfulConfig['siteEntryId'];
$entry = $client->getEntry($siteId);

$login_error = false;

session_start();

if(isset($_POST['page_login']) && isset($_POST['uname']) && isset($_POST['pword'])) {
  $user = $_POST['uname'];
  $pass = $_POST['pword'];

  foreach ($entry->getUsers() as $siteUser) {
    if($user == $siteUser->getUsername() && $pass == $siteUser->getPassword()) {
      $_SESSION['user']=$user;
    } else {
      $login_error = true;
    }
  }


}

if(isset($_POST['page_logout'])) {
  unset($_SESSION['user']);
}


if(isset($_SESSION['user'])) {
  require_once 'logged_in.php';
} else {
  require_once 'login.php';
}
?>
