@section('pageTitle', __('Under Construction') . ' | ' . config('panel.site_title'))

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle')</title>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, white 50%, #f8f5f0 50%);
            font-family: "Abel", Arial, sans-serif; /* Use the "Abel" font */
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .logo {
            width: 500px;
            height: auto;
            max-width: 100%;
        }

        .text {
            text-align: center;
            color: #000;
        }

        .text h1 {
            font-size: 22px;
            margin: 10px 0;
        }

        .text h2 {
            font-size: 18px;
            margin: 10px 0;
        }

        .text h3 {
            font-size: 18px;
            margin: 10px 0;
        }

        .accent-text {
            color: #8e794c;
            font-size: 18px;
        }

        .contact-info {
            font-size: 18px;
            margin-top: 20px;
        }

        .contact-info a {
            text-decoration: none;
            color: #8e794c;
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="logo" src="{{ asset('assets/images/new/tagproperties.png') }}" alt="TagProperties.com Logo">
        <div class="text">
            <H1>TagProperties.com is Getting a Fresh Makeover!</h1>
            <h2>Get ready for a whole new level of real estate awesomeness!</h2>
            <h3>We're hard at work behind the scenes to bring you an exciting, user-friendly, and informative website that will make your property journey extraordinary.</h3>
            <p>In the meantime, let's keep in touch. Follow us on social media for the latest updates and sneak peeks:</p>
			<!--<p class="accent-text">Coming Soon!</p>-->
            <p class="contact-info">Follow us on <a href="https://www.facebook.com/tagproperties.ae/" target="_blank">Facebook</a></p>
            <p class="contact-info">Contact us at <a href="mailto:info@tagproperties.com">info@tagproperties.com</a></p>
        </div>	
    </div>
</body>
</html>