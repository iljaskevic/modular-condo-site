<?php
// Page that gets rendered when user successfully logs in

$userPageId = $contentfulConfig['userPageEntryId'];
$userPageEntry = $client->getEntry($userPageId);

?>

  <h1>Create Password Protected Webpage Using PHP, HTML And CSS</h1>
  <h2>Site: <?php echo $userPageEntry->getTitle(); ?></h2>
  <form method="post" action="/user" id="logout_form">
    <input type="submit" name="page_logout" value="LOGOUT">
  </form>

<?php


?>
