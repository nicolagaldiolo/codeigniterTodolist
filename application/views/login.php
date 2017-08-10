<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">

    <link rel="stylesheet" href="/assets/login.css">

</head>
<body>

<section>
    <!-- Form -->
    <div>
        <form method="post" action="<?php echo site_url('welcome/login'); ?>">
            <label for="email">Email *</label>
            <input type="email" name="email">

            <label for="password">Password *</label>
            <input type="password" name="password">
            <button type="submit">Login</button>
        </form>

        <?php if( function_exists('validation_errors')) { echo validation_errors(); } ?>

    </div>

</section>

</body>
</html>