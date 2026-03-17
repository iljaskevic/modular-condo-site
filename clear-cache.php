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

// Define function for deleting non-empty folder
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

// Clearing cache by deleting folder only if header is set correctly

if (isset($_SERVER['HTTP_WEBHOOK_AUTH_TOKEN'])) {
    $authToken = $_SERVER['HTTP_WEBHOOK_AUTH_TOKEN'];
} else {
    $authToken = "NOT_SET";
}

if ($authToken == $contentfulConfig['webhookAuthToken']) {

  $dir = __DIR__ . '/cache/app.cache';
  deleteDirectory($dir);
  echo 'Deleted cache folder: ' . $dir;

} else {
  http_response_code(403);
  echo "Failed to clear cache - token mismatch";
  exit();
}

?>
