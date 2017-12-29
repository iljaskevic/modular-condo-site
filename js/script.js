$(function() {
	var markers = [];
	var markersShown = false;
	$(".show-parking-btn").find(".glyphicon-ok").hide();
	$(".map-legend").hide();
	$("#lightgallery").lightGallery({
		thumbnail: true
	});
	$("#lightgallery").justifiedGallery({
		rowHeight : 200,
		lastRow : 'hide'
	});
	var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    // direction: 'vertical',
		loop: true,
		delay: 600,

		autoplay: {
			delay: 5000,
			disableOnInteraction: false
		},

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

	var createMarker = function(title, subtitle, logo, image, lat, lng) {
		var infowindow = new google.maps.InfoWindow({
			content: "<h4>"+title+"</h4><h5>"+subtitle+"</h5><img src='images/"+image+"'>"
		});

		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(lat, lng),
			//map: map,
			icon: 'images/' + logo
		});
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});

		markers.push(marker);
	};
	var setAllMap = function(map) {
	  for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	  }
	};

	var condoLocation = new google.maps.LatLng(43.654504, -79.378980);
	var mapOptions = {
		center: condoLocation,
		zoom: 17,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: false,
		draggable: true,
		panControl: false,
		zoomControl: true,
		mapTypeControl: false,
		scaleControl: false,
		streetViewControl: false,
		overviewMapControl: false,
		rotateControl: false,
		styles: [
			{
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#ebe3cd"
					}
				]
			},
			{
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#523735"
					}
				]
			},
			{
				"elementType": "labels.text.stroke",
				"stylers": [
					{
						"color": "#f5f1e6"
					}
				]
			},
			{
				"featureType": "administrative",
				"elementType": "geometry",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "administrative",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#c9b2a6"
					}
				]
			},
			{
				"featureType": "administrative.land_parcel",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#dcd2be"
					}
				]
			},
			{
				"featureType": "administrative.land_parcel",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#ae9e90"
					}
				]
			},
			{
				"featureType": "landscape.natural",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#dfd2ae"
					}
				]
			},
			{
				"featureType": "poi",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#dfd2ae"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#93817c"
					}
				]
			},
			{
				"featureType": "poi.park",
				"elementType": "geometry.fill",
				"stylers": [
					{
						"color": "#a5b076"
					}
				]
			},
			{
				"featureType": "poi.park",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#447530"
					}
				]
			},
			{
				"featureType": "road",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#f5f1e6"
					}
				]
			},
			{
				"featureType": "road",
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road.arterial",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#fdfcf8"
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#f8c967"
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#e9bc62"
					}
				]
			},
			{
				"featureType": "road.highway.controlled_access",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#e98d58"
					}
				]
			},
			{
				"featureType": "road.highway.controlled_access",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#db8555"
					}
				]
			},
			{
				"featureType": "road.local",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#806b63"
					}
				]
			},
			{
				"featureType": "transit",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "transit.line",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#dfd2ae"
					}
				]
			},
			{
				"featureType": "transit.line",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#8f7d77"
					}
				]
			},
			{
				"featureType": "transit.line",
				"elementType": "labels.text.stroke",
				"stylers": [
					{
						"color": "#ebe3cd"
					}
				]
			},
			{
				"featureType": "transit.station",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#dfd2ae"
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "geometry.fill",
				"stylers": [
					{
						"color": "#b9d3c2"
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#92998d"
					}
				]
			}
		]
    };
	var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

	var mainInfoWindow = new google.maps.InfoWindow({
		content: "<h4>Condo Location</h4><h5>200 Victoria Street</h5><h5>Toronto, Ontario</h5><h5>Canada</h5><h5>M5B 1V8</h5>"
	});
	var mainMarker = new google.maps.Marker({
		position: condoLocation,
		map: map,
		title: 'Condo Location',
		icon: 'images/star.png'
	});
	mainInfoWindow.open(map, mainMarker);
	google.maps.event.addListener(mainMarker, 'click', function() {
		mainInfoWindow.open(map, mainMarker);
	});

	createMarker("Public Street Parking","on Victoria St.","public-parking-logo4.png", "parking-01.jpg", 43.655329, -79.379213);
	createMarker("Private Parking Lot","on Victoria St. south of Dundas St.","private-parking-logo.png", "parking-02.jpg", 43.655568, -79.378958);
	createMarker("Private Parking Lot","on intersection of Dundas St. and Bond St.","private-parking-logo.png", "parking-03.jpg", 43.656066, -79.377920);
	createMarker("Public Parking Lot","on Church St. north of Dundas St.","public-parking-logo4.png", "parking-04.jpg", 43.657027, -79.377671);
	createMarker("Private Parking Lot","on intersection of Dundas St. and Mutual St.","private-parking-logo.png", "parking-05.jpg", 43.656066, -79.377920);
	createMarker("Private Parking Lot","on intersection of Church St. and Shuter St.","private-parking-logo.png", "parking-06.jpg", 43.655038, -79.376296);
	createMarker("Private Parking Lot","on intersection of Shuter St. and Dalhousie St.","private-parking-logo.png", "parking-07.jpg", 43.654668, -79.375246);
	createMarker("Public Parking Lot","on Church St. south of Shuter St.","public-parking-logo4.png", "parking-08.jpg", 43.654427, -79.376565);
	createMarker("Underground Parking Lot","at Dundas Square","public-parking-logo4.png", "parking-09.jpg", 43.656005, -79.379595);
	createMarker("Ryerson University Parking Lot","on Victoria St. north of Dundas St.","public-parking-logo4.png", "parking-10.jpg", 43.656933, -79.379993);
	createMarker("Public Street Parking","on Bond St. south of Shuter St.","public-parking-logo4.png", "parking-11.jpg", 43.653663, -79.377198);
	createMarker("Public Street Parking","on Church St. south of Shuter St.","public-parking-logo4.png", "parking-12.jpg", 43.653830, -79.376053);
	createMarker("Public Street Parking","on Dalhousie St. south of Shuter St.","public-parking-logo4.png", "parking-13.jpg", 43.654235, -79.375544);
	createMarker("Public Street Parking","on Mutual St. south of Shuter St.","public-parking-logo4.png", "parking-14.jpg", 43.654445, -79.374677);
	createMarker("Public Street Parking","on Shuter St. east of Mutual St.","public-parking-logo4.png", "parking-15.jpg", 43.655258, -79.374406);
	createMarker("Public Street Parking","on Mutual St. north of Shuter St.","public-parking-logo4.png", "parking-16.jpg", 43.655856, -79.375214);
	createMarker("Public Street Parking","on Shuter St. east of Dalhousie St.","public-parking-logo4.png", "parking-17.jpg", 43.655029, -79.375444);
	createMarker("Public Street Parking","on Dalhousie St. north of Shuter St.","public-parking-logo4.png", "parking-18.jpg", 43.655683, -79.376120);
	createMarker("Public Street Parking","on Church St. north of Shuter St.","public-parking-logo4.png", "parking-19.jpg", 43.655621, -79.376753);
	createMarker("Public Street Parking","on Shuter St. east of Bond St.","public-parking-logo4.png", "parking-20.jpg", 43.654660, -79.377188);

	$(".show-parking-btn").click(function() {
		$(this).find(".glyphicon-ok").toggle();
		$(".map-legend").toggle();
		if (markersShown) {
			setAllMap(null);
			markersShown = false;
		} else {
			setAllMap(map);
			markersShown = true;
		}
	});

	$(".menu-btn").click(function() {
		if ($(this).attr("id") == "home") {
			$('html, body').animate({
				scrollTop: 0
			}, 500);
		} else {
			$('html, body').animate({
				scrollTop: $("."+$(this).attr("id") + "-section").offset().top - 100
			}, 500);
		}
	});
	function success(data) {
		$("#contact-us-success").text("Thank you for contacting us! We will respond as soon as possible.");
		$("#contact-us-success").removeClass("hidden");
		$("#contact-us-error").addClass("hidden");
		$('html, body').animate({
			scrollTop: $("#contact-us-success").offset().top - 100
		}, 500);
	}
	function error(error) {
		$("#contact-us-error").text("Oop! Something went wrong.");
		$("#contact-us-error").removeClass("hidden");
		$("#contact-us-success").addClass("hidden");
		$('html, body').animate({
			scrollTop: $("#contact-us-error").offset().top - 100
		}, 500);
	}
	var oforms = new oForm("contact-us-form", "d0db0c51-2a11-41cd-b6c5-e5e2a6b03618",{
		success: success,
		error: error
	});
});
