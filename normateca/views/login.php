<?php 

include_once("../controllers/backend/loginController.php");
setLogin();

// if (count($_SESSION['cuerpos']) > 0) {
// foreach ($_SESSION['cuerpos'] as $cat) {
//     echo $cat['corp_abbr'], $cat['corp_name'];
// }
// }
                 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Normateca Log In</title>
    <link rel="stylesheet" href="../assets/css/login.css" />
</head>

<body>
    <header>
        <img src="../assets/images/arecibo.png" />
        <div>
            <h1>Normateca</h1>
            <h3><i> Universidad de Puerto Rico en Arecibo </i></h3>
        </div>
    </header>


    <section class="login">
        <form class="loginForm" action="../controllers/backend/loginController.php" method="POST">
            <input type="hidden" name="log" value="1">
            <h1>Welcome to Normateca</h1>

            <h4>Fill out the following fields to log in:</h4>

            <label for="email">Email: </label>
            <input type="email" value="" name="email" id="email" placeholder="Enter your email" />
            <br />
            <label for="password">Password: </label>
            <input type="text" value="" name="password" id="password" placeholder="Enter your Password" />
            <br />
            <label for="password">Cuerpos: </label>
            <select id="cuerpo" name="cuerpo">
            <option disabled selected>Cuerpos</option>
                <?php
                if (count($_SESSION['cuerpos']) > 0) {
                foreach ($_SESSION['cuerpos'] as $cat) {
                    echo '<option value="' . $cat['corp_abbr'] . '">' . $cat['corp_name'] . '</option>';
                }
                }
                ?>
            </select><br>
            <div class="remember">
                <input type="checkbox" name="Remember" id="Remember" />
                <label for="Remember" id="remblbl">Remember me</label>
            </div>

            <button class="btn" type="submit">Log In</button>
        </form>
    </section>

    <!-- <section>
        <form action="../controllers/backend/loginController.php" method="post">
            <input type="hidden" name="log" value="2">
            <input type="hidden" name="hash" value="true" />
            <label>password: </label>
            <input type="input" name="password"  />
            <label >user_id: </label>
            <input type="input" name="id"  />
            <button class="btn" type="submit">hash</button>
        </form>
    </section> -->
</body>

</html>