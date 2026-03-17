<?php
require_once 'vendor/autoload.php';
if(file_exists('config.php')) {
  $config = require_once('config.php');
} else {
  $config = [
    'contentful' => [
      'accessKey' => getenv("CONTENTFUL_ACCESS_KEY"),
      'spaceId' => getenv("CONTENTFUL_SPACE_ID"),
      'siteEntryId' => getenv("CONTENTFUL_SITE_ENTRY_ID"),
      'userPageEntryId' => getenv("CONTENTFUL_USER_PAGE_ENTRY_ID"),
      'webhookAuthToken' => getenv("CONTENTFUL_WEBHOOK_AUTH_TOKEN")
    ],
    'oFormsApiKey' => getenv("OFORMS_API_KEY"),
  ];
}
$contentfulConfig = $config['contentful'];


if (empty($contentfulConfig['accessKey']) 
  || empty($contentfulConfig['spaceId'])
  || empty($contentfulConfig['siteEntryId'])
  || empty($contentfulConfig['webhookAuthToken'])) {

  http_response_code(500);
  echo "Missing Contentful config";
  exit();

} else {
    echo "All Contentful config variables are set";
}

?>
