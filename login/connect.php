<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bee House</title>
        <link rel="stylesheet" href="style.css">
        
    </head>
    <body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "beehouse";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO lessor (username, email, password)
        VALUES ('akocmarjan', 'akocmarjan@gmail.com', '1234')";

        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    ?>
        <div class="popup">
            <div class="close-btn">&times;</div>
            <div class="form">
                <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'Signin')" id="defaultOpen">Sign in</button>
                    <button class="tablinks" onclick="openTab(event, 'Signup')">Sign up</button>
                </div>
                <div id="Signin" class="tabcontent">
                    <h2>Sign in</h2>
                    <div class="form-element">
                        <label for="email">Email</label>
                        <input type="text" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-element">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Enter password">
                    </div>
                    <div class="form-element">
                        <input type="checkbox" id="remember-me">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <div class="form-element">
                        <button>Sign in</button>
                    </div>
                    <div class="form-element">
                        <a href="#">Forgot password</a>
                    </div>
                </div>
                <div id="Signup" class="tabcontent">
                    <h2>Sign up</h2>
                    <div class="form-element">
                        <label for="type">Sign Up Type</label>
                        <!-- <input type="text" id="type" placeholder="Lessor/Tenant"> -->
                        <select name="types" id="types">
                            <option value="lessor">Lessor</option>
                            <option value="tenant">Tenant</option>
                        </select>
                    </div>
                    <div class="form-element">
                        <label for="username">Username</label>
                        <input type="text" id="username" placeholder="Enter username">
                    </div>
                    <div class="form-element">
                        <label for="email">Email</label>
                        <input type="text" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-element">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Enter password">
                    </div>
                    <div class="form-element">
                        <label for="password">Confirm Password</label>
                        <input type="password" id="password" placeholder="Enter password">
                    </div>
                    <div class="form-element">
                        <input type="checkbox" id="remember-me">
                        <label for="remember-me">I agree with the terms and conditions</label>
                    </div>
                    <div class="form-element">
                        <button>Sign up</button>
                    </div>
                    
                </div>
            </div>
        </div>


        <div class="header">
            <nav>
                <img src="images/logo.png" class="logo">
                <ul class="nav-links">
                    <li><a href="#" class="active">Home</a></li>
                </ul>
                <!-- <a href="#" class="show-login">Login</a> -->
                <div class="login-btn">
                    <button id="show-login">Login</button>
                </div>
            </nav>
            <div class="container">
                <h1>Looking for a Place to Stay?</h1>
                <div class="search-bar">
                    <form>
                        <div class="location-input">
                            <label>Location</label>
                            <input type="text" placeholder="Where are you going?">
                        </div>
                        <button type="submit"><img src="images/search.png"></button>
                    </form>
                </div>
                <div class="bot">
                    <h2>Become a Lessor</h2>
                    <a href="#" class="signup-btn" id="signup-btn">Sign Up Here</a>
                </div>
            </div>
            <div class="footer">
                <a href="https://facebook.com/">Facebook</a>
                <a href="https://facebook.com/">Instagram</a>
                <a href="https://facebook.com/">Youtube</a>
                <a href="https://facebook.com/">Twitter</a>
                <hr>
                <p>Copyright 2021, Bee House</p>
            </div>
        </div>
    </body>
</html>
<script src="java.js"></script>