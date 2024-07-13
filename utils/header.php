<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEMS</title>
    <style>
        .bgImage {
            position: relative;
            overflow: hidden;
            height: 100vh; /* Change height to cover entire viewport */
            margin-bottom: 25px;
        }
        ul{
            font: 1.2em sans-serif;
        }
        .wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%; /* Set width to cover entire viewport */
            height: 100%; /* Set height to cover entire viewport */
            display: flex;
        }

        .wrapper img {
            min-width: 100%; /* Set minimum width to cover entire viewport */
            min-height: 100%; /* Set minimum height to cover entire viewport */
            object-fit: cover; /* Ensure images cover the entire space */
            animation: slide 16s infinite;
        }

        .content {
            position: relative;
            z-index: 2;
            color: black; 
            padding-top: 100px; 
        }

        .navbar {
            z-index: 3; 
            position: relative;    
        }

        @media only screen and (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .navbar li a {
    text-decoration: none;
}
        }

        .navbar-header .navbar-brand {
            z-index: 10; 
            position: relative;
        }

        @keyframes slide {
            0% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(0);
            }
            30% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(-100%);
            }
            75% {
                transform: translateX(-200%);
            }
            80% {
                transform: translateX(-300%);
            }
            100% {
                transform: translateX(-300%);
            }
        }
    </style>
</head>
<body>

<header class="bgImage">
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header">
                
            </div>
            <ul class="nav navbar-nav navbar-right" >
                <li><a href="index.php"><strong>Home</strong></a></li>
                
                <li><a href="contact.php"><strong>Contact Us</strong></a></li>
                <li><a href="aboutus.php"><strong>About us</strong></a></li>
                <li><a href="showachi.php"><strong>Show Acheievements</strong></a></li>
                <li class="btnlogout"><a class="btn btn-default navbar-btn" href="login_form.php">Login <span
                            class="glyphicon glyphicon-log-in"></span></a></li>
            </ul>
        </div>
    </nav>
    <div class="content">
        <div class="container">
            <div class="jumbotron">
                <h1><strong>Enrich Your Mind<br></strong>Find Your Place in Academia</h1>
                <!--jumbotron heading-->
            </div>
            <div class="browse d-md-flex col-md-14">
                <div class="row">
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <img src="images/Img-1.jpg" alt="Slide 1"/>
        <img src="images/Img-2.jpg" alt="Slide 2"/>
        <img src="images/ing-3.jpg" alt="Slide 3"/>
        <img src="images/img-4.png" alt="Slide 4"/>
    </div>
</header>

</body>
</html>
