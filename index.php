<?php

/**
 * trapped-box
 *
 * Serving protected content over HTTPS with NGINX 
 *
 * @author    Austin <github.com/insdavm>
 * @date      2017.03.06
 * @license   MIT
 */

$feedback = null;

/* 
 * $hash == "password"
 * 
 * You can change to use whatever password you want by running php from the
 * command line like so:
 * 
 *   $ php -a
 *   Interactive mode enabled
 *
 *   php > echo password_hash("password", PASSWORD_DEFAULT);
 *   $2y$10$jsA31Bo8OlxchyRln2VT6eIjqYf/4n83mX1rcG4QRprIVFVHBkYgm
 *   php > quit
 *
 */
$hash = '$2y$10$jsA31Bo8OlxchyRln2VT6eIjqYf/4n83mX1rcG4QRprIVFVHBkYgm';

if ( !empty($_POST['password']) ) {

    if ( password_verify($_POST['password'], $hash) ) {

        /*
         * Use the X-Accel-Redirect header to make a request for an 
         * internal-only resource (ref: NGINX configuration file)
         * 
         * (Apache uses "X-Send-File")
         */
        Header('X-Accel-Redirect: /protected/file.zip');

        /*
         * Set the content type so that the browser knows how to render the data
         */
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=file.zip");  

        /*
         * Exit
        */
        exit(0);
	
    } else {

        $feedback = "Wrong Password.";

    }
} 

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>trapped-box</title>
    </head>
    <body>
    <div class="center login" id="login">
    <form action="index.php" method="POST">
	<input type="password" name="password" placeholder="Password" size="20" class="login-input" required autofocus /><br />
	<input type="submit" class="login-input login-button" name="submit" value="Go" />
    </form>
    <p><?= $feedback ? $feedback : null; ?></p>
</div>
</body>
</html>
