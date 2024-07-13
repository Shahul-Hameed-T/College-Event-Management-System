<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>cems</title>
    <style>
        .bgImage {
            background-image: url(images/img-4.png);
            background-size: cover;
            background-position: center center;
            height: 100vh; 
            margin-bottom: 29px;
        }

        ul {
            font: 1.2em sans-serif;
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
        
        
    </style>
</head>

<body>
    <?php require 'utils/styles.php'; ?>
    
    <header class="bgImage">
        <nav class="navbar">
            <div class="container">
                <ul class="nav navbar-nav navbar-right"><!--navigation-->
                    <li><a href="adminPage.php"><strong>Home</strong></a></li>
                    <li><a href="Stu_details.php"><strong>Student Details</strong></a></li>
                    <li><a href="Stu_cordinator.php"><strong>Student Co-ordinator</strong></a></li>
                    <li><a href="Staff_cordinator.php"><strong>Staff-Co-ordinator</strong></a></li>
                    <li class="btnlogout"><a class="btn btn-default navbar-btn" href="index.php">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>
                </ul>
            </div><!--container div-->
        </nav>
        <div class="col-md-12">
            <div class="container">
                <div class="jumbotron"><!--jumbotron-->
                    <div class="browse d-md-flex col-md-14">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
