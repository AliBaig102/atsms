<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideHub | Smart Auto & Taxi Stand Management</title>

    <!-- CSS Links -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/slider.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- jQuery and Slider Scripts -->
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/camera.min.js"></script>

    <style>
        /* General Styles */
        body, html {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
        }

        /* Header */
        .header {
            position: absolute;
            width: 100%;
			height: 120px;
            top: 0;
            left: 0;
            /* padding: 15px 0; */
            background: rgba(30, 41, 59, 0.8); /* Semi-transparent */
            z-index: 1000;
        }
		.wrap{
			display: flex;
			align-items: center;
			justify-content: space-between;
			height: 100%;
		}
        .logo img {
			width: 70%;
			height: 100%;
			object-fit: cover;
        }

        /* Navigation */
        .top-nav {
            text-align: center;
        }

        .top-nav ul {
            list-style: none;
            padding: 0;
        }

        .top-nav ul li {
            display: inline;
            margin: 0 15px;
        }

        .top-nav ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
        }

        .top-nav ul li a:hover {
            color: #FFD700;
        }

        /* Fullscreen Slider */
        .slider {
            width: 100%;
            height: 100vh; /* Full height */
            position: relative;
        }

        .camera_wrap {
            width: 100%;
            height: 100vh !important; /* Fullscreen */
        }

        .camera_wrap .cameraSlide {
            background-size: cover !important;
            background-position: center !important;
        }

        /* Centered content over the slider */
        .slider-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
            z-index: 10;
            width: 80%;
        }

        .slider-content h1 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .slider-content p {
            font-size: 18px;
            opacity: 0.9;
        }

        .copy-right {
            text-align: center;
            padding: 15px;
            background: #1E293B;
            color: #fff;
            font-size: 14px;
        }

        .copy-right a {
            color: #FFD700;
            text-decoration: none;
            font-weight: 600;
        }

        .copy-right a:hover {
            text-decoration: underline;
        }
    </style>

    <script>
        jQuery(function () {
            jQuery('#camera_wrap_1').camera({
                height: '100vh', // Fullscreen
                pagination: false,
                thumbnails: false,
                playPause: false,
                navigation: false,
                fx: 'simpleFade'
            });
        });

        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1200);
            });
        });
    </script>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="wrap">
            <div class="logo">
			<!-- <h3>RideHub - Smart Auto & Taxi Stand Management</h3> -->
			 <img src="images/ridehub-transparent.png" alt="" width="200">
            </div>

            <div class="top-nav">
                <ul>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="search.php" target="_blank">Check Stand Receipt</a></li>
                    <li><a href="admin/index.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Fullscreen Image Slider -->
    <div class="slider">
        <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
            <div data-src="images/slider1.jpg"></div>
            <div data-src="images/slider2.jpg"></div>
            <div data-src="images/slider3.jpg"></div>
            <div data-src="images/slider4.jpg"></div>
        </div>

        <!-- Text Over the Slider -->
        <div class="slider-content">
            <h1>Welcome to Effortless Taxi & Auto Stand Management</h1>
            <p>Efficiently manage auto and taxi stands with our powerful system.</p>
        </div>
    </div>
</body>

</html>
