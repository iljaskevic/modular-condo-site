<?php
require_once 'vendor/autoload.php';
$config = require_once('config.php');
$contentfulConfig = $config['contentful'];

$client = new \Contentful\Delivery\Client($contentfulConfig['accessKey'], $contentfulConfig['spaceId']);
$parsedown = new Parsedown();

$siteId = $contentfulConfig['siteEntryId'];
$entry = $client->getEntry($siteId);

$headerImageOptions = new \Contentful\File\ImageOptions;
$headerImageOptions->setFormat('jpg')->setHeight(1200);

$imageOptions = new \Contentful\File\ImageOptions;
$imageOptions->setFormat('jpg')->setHeight(1000);

$thumbnailOptions = new \Contentful\File\ImageOptions;
$thumbnailOptions->setFormat('jpg')->setHeight(250);

?>


<html lang="en">
TEST TEST TEST
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $entry->getSiteDomain(); ?></title>
	<meta name="description" content="Long and short term condo for rent in downtown Toronto" />
	<meta name="keywords" content="rent,Toronto,toronto,downtown,location,best location,central toronto,central,furnished,fully furnished,Dundas station,subway station" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700i" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://oformsapi.azurewebsites.net/js/v1/oforms.js"></script>

    <!-- Daterangepicker Include Required Prerequisites -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />

    <!-- Include Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="css/lightgallery.min.css" />
    <link rel="stylesheet" type="text/css" href="css/justifiedGallery.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

      <?php
        echo
          '<script>
            var emailApiKey = "' . $config['oFormsApiKey'] . '";
          </script>';

        if ($entry->getLogoTextColour()) {
          echo
            '<style>
              .a.navbar-brand .logo-text {
                color: #' . $entry->getLogoTextColour() . ' !important;
              }
            </style>';
        }

        if ($entry->getDarkestColour()) {
          echo
            '<style>
              .navbar-default {
                background-color: #' . $entry->getDarkestColour() . ' !important;
              }
              .footer {
                background-color: #' . $entry->getDarkestColour() . ' !important;
              }
              .gallery-section {
                background-color: #' . $entry->getDarkestColour() . ' !important;
              }
              .map-options {
                background-color: #' . $entry->getDarkestColour() . ' !important;
              }
            </style>';
        }
        if ($entry->getDarkColour()) {
          echo
            '<style>

            </style>';
        }
        if ($entry->getMediumColour()) {
          echo
            '<style>


            </style>';
        }
        if ($entry->getLightColour()) {
          echo
            '<style>
              .navbar-default .navbar-nav>li>a {
                color: #' . $entry->getLightColour() . ' !important;
              }
            </style>';
        }
        if ($entry->getLightestColour()) {
          echo
            '<style>
              body {
                background-color: #' . $entry->getLightestColour() . ' !important;
              }
              .a.navbar-brand .logo-text {
                color: #' . $entry->getLightestColour() . ' !important;
              }
              .navbar-default .navbar-nav {
                border-color: #' . $entry->getLightestColour() . ' !important;
              }
              .map-options .show-parking-btn {
                color: #' . $entry->getLightestColour() . ' !important;
              }
            </style>';
        }
      ?>
      <script>
        $(function() {
          $('.contact-us-form input[name="daterange"]').flatpickr({
            mode: 'range',
            <?php
              if ($entry->getAvailableFromDate()) {
                echo
                  'minDate: "' . $entry->getAvailableFromDate()->format('Y-m-d') . '",
                  defaultDate: "' . $entry->getAvailableFromDate()->format('Y-m-d') . '",';
              } else {
                echo
                  'minDate: "today",';
              }
            ?>
            disable: [
              <?php
                foreach ($entry->getBookedDateRanges() as $bookedRange) {
                  echo
                    '{
                      from: "' . $bookedRange->getStartDate()->format('Y-m-d') . '",
                      to: "' . $bookedRange->getEndDate()->format('Y-m-d') . '"
                    },';
                }
              ?>
            ]
          });
        });
      </script>
  </head>
  <body>
  	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
            <!--<img class="img-responsive" src="images/logo5.png">-->
            <span class="logo-text"><?php echo $entry->getLogoText(); ?></span>
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a class="menu-btn" id="home">Home</a></li>
            <li><a class="menu-btn" id="gallery">Gallery</a></li>
            <li><a class="menu-btn" id="pricing">Pricing</a></li>
            <li><a class="menu-btn" id="map">Map</a></li>
            <li><a class="menu-btn" id="faq">FAQ</a></li>
            <li><a class="menu-btn" id="contact">Contact Us</a></li>
            <!--<li class="active"><a href="">Login</a></li>-->
          </ul>
        </div>
      </div>
    </nav>

    <div class="main-wrapper container">
    	<div class="row">
        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                    $sliderIndex = 1;
                    foreach ($entry->getHeaderImages() as $headerImage) {
                      echo
                        '<style>
                          .slider-item-' . $sliderIndex . ' {
                            background-image: url("' . $headerImage->getFile()->getUrl($headerImageOptions) . '");
                          }
                        </style>
                        <div class="swiper-slide slider-item slider-item-' . $sliderIndex . '">
                          <div class="carousel-caption">
                            <h3>' . /*$headerImage->getTitle() .*/ '</h3>
                            <p>' . $headerImage->getDescription() . '</p>
                          </div>
                        </div>';
                        $sliderIndex += 1;
                    }
                ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        	<!--<div id="carousel-header" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-header" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-header" data-slide-to="1"></li>
                <li data-target="#carousel-header" data-slide-to="2"></li>
              </ol>

              <div class="carousel-inner" role="listbox">
                <?php
                    $isActive = 'active';
                    foreach ($entry->getHeaderImages() as $headerImage) {
                      echo
                        '<div class="item ' . $isActive . '">
                          <img src="' . $headerImage->getFile()->getUrl($headerImageOptions) . '" alt="...">
                          <div class="carousel-caption">
                            <h3>' . /*$headerImage->getTitle() .*/ '</h3>
                            <p>' . $headerImage->getDescription() . '</p>
                          </div>
                        </div>';
                      $isActive = '';
                    }
                ?>
              </div>

              <a class="left carousel-control" href="#carousel-header" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-header" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>-->
        </div>
        <div class="row row-padded">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="page-header">
                <h1><?php echo $entry->getMainHeading(); ?></h1>
            </div>
            <div>
              <h3><?php echo $entry->getDescriptionTitle(); ?></h3>

              <?php echo $parsedown->text($entry->getDescriptionText());?>

              <div class="alert alert-warning" role="alert">
                <?php echo $parsedown->text($entry->getDescriptionNote());?>
              </div>
            </div>
          </div>
        </div>
        <div class="row row-padded gallery-section">
          <!--<div class="col-lg-8 col-lg-offset-2">
        	  <div class="page-header">
              <h2>Gallery</h2>
            </div>
          </div>-->
          <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                  <div id="lightgallery">
                    <?php
                        foreach ($entry->getGalleryImages() as $galleryImage) {
                          echo
                            '<a href="' . $galleryImage->getFile()->getUrl($imageOptions) . '">
                                <img src="' . $galleryImage->getFile()->getUrl($thumbnailOptions) . '" />
                            </a>';
                        }
                    ?>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="row row-padded pricing-section">
          <div class="col-lg-8 col-lg-offset-2">
        	  <div class="page-header">
              <h2>Pricing</h2>
            </div>
            <div>
            	<div class="row">
                	<div class="col-lg-12">
                        <h4>Please <a class="menu-btn" id="contact">contact us</a> for up to date pricing.</h4>
                    	<!--<div class="panel panel-default" style="margin-top:30px;">

                          <table class="table">
                            <thead>
                              <tr>
                                <th></th>
                                <th>Per Calendar Month</th>
                                <th>Per Week (7-Consecutive Days)</th>
                                <th>Per Day</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>September - May</td>
                                <td>$1,980</td>
                                <td>$750</td>
                                <td>$130</td>
                              </tr>
                              <tr>
                                <td>June - August</td>
                                <td>$2,250</td>
                                <td>$950</td>
                                <td>$160</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>-->
                          <div class="panel-body">
                            <!--<p>*Minimum 30 days rent</p>-->
                          </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="row map-section">
            <div id="map-canvas"></div>
            <div class="map-options">
              <div class="checkbox">
                <div>
                  <a class="show-parking-btn">
                    <div class="show-parking-box">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </div>
                    Display Parking Spots
                  </a>
                </div>
              </div>
              <div class="map-legend pull-right">
                <div style="display: inline-block;">
                  <img src="images/public-parking-logo4.png"> - Public
                </div>
                <div style="display: inline-block;">
                  <img src="images/private-parking-logo.png"> - Private
                </div>
              </div>
            </div>
        </div>
        <div class="row row-padded faq-section">
          <div class="col-lg-8 col-lg-offset-2">
        	  <div class="page-header">
              <h2>Frequently Asked Questions</h2>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <?php
                  $faqIndex = 1;
                  $faqExpanded = 'true';
                  $faqCollapsedClass = '';
                  $faqExpandedClass = 'in';
                  foreach ($entry->getfaqList() as $faqItem) {
                    echo
                      '<div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading-' . $faqIndex . '">
                          <h4 class="panel-title">
                            <a class="' . $faqCollapsedClass . '" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $faqIndex . '" aria-expanded="' . $faqExpanded . '" aria-controls="collapse-' . $faqIndex . '">'
                              . $parsedown->text($faqItem->getQuestion()) .
                            '</a>
                          </h4>
                        </div>
                        <div id="collapse-' . $faqIndex . '" class="panel-collapse collapse ' . $faqExpandedClass . '" role="tabpanel" aria-labelledby="heading-' . $faqIndex . '">
                          <div class="panel-body">'
                            . $parsedown->text($faqItem->getAnswer()) .
                          '</div>
                        </div>
                      </div>';
                    $faqIndex += 1;
                    $faqExpanded = 'false';
                    $faqCollapsedClass = 'collapsed';
                    $faqExpandedClass = '';
                  }
              ?>
            </div>
          </div>
        </div>
        <div class="row row-padded contact-section">
          <div class="col-lg-8 col-lg-offset-2">
        	  <div class="page-header">
              <h1>Contact Us</h1>
            </div>
            <div class="row">
            	<form name="contact-us-form" id="contact-us-form" class="contact-us-form">
                  <div class="form-group col-lg-12">
                    <div id="contact-us-success" class="alert alert-success hidden" role="alert"></div>
                    <div id="contact-us-error" class="alert alert-danger hidden" role="alert"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="cell">Cell Phone</label>
                    <input type="text" class="form-control" id="cell" name="cell" placeholder="Cellphone Number">
                  </div>
                  <div class="form-group col-lg-12">
                    <label for="daterange">Rent Period</label>
                  </div>
                  <div class="form-group col-sm-6">
                    <input id="daterange" type="text" id="daterange" name="daterange" class="form-control"  placeholder="Click to Select Start/End Dates"/>
                  </div>
                  <div class="form-group col-sm-6 available-from-date">
                    <?php
                      if ($entry->getAvailableFromDate()) {
                        echo 'Available from <strong>' . $entry->getAvailableFromDate()->format('F d, Y') . '</strong>';
                      }
                    ?>
                  </div>
                  <div class="form-group col-lg-12">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" placeholder="Message" rows="5"></textarea>
                  </div>
                  <div class="form-group col-lg-12">
                    <div class="g-recaptcha" data-sitekey="6LcmiDwUAAAAAC-AwrQzd9DxFYPZyhZ9dkg4Mvmf"></div>
                  </div>
                  <div class="form-group col-lg-12">
                    <button type="submit" class="btn btn-default btn-lg pull-right">Submit</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
    </div>

    <div class="footer">
    	<div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            Copyright @ 2015 - <?php echo $entry->getSiteDomain(); ?>
          </div>
          <div class="col-xs-12 col-sm-6">
            <!--<span class="pull-right">Design by Igor Ljaskevic</span>-->
          </div>
        </div>
      </div>
    </div>


    <!--<script src="js/libraries/jquery-1.11.3.min.js"></script>-->
	  <script src="js/libraries/jquery.validate.min.js"></script>
	  <script src="js/libraries/additional-methods.min.js"></script>
	  <script type="text/javascript" src="js/libraries/moment.min.js"></script>

    <script src="js/libraries/lightgallery.min.js"></script>
    <!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>-->
    <!-- lightgallery plugins -->
    <script src="js/libraries/lg-thumbnail.min.js"></script>
    <script src="js/libraries/lg-fullscreen.min.js"></script>

    <script src="js/libraries/jquery.justifiedGallery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="js/libraries/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe58CsNmTVsMOPsuMsjBqUwSjYDsW4ewI&sensor=false"></script>
  </body>
</html>
