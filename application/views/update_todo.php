<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">

    <link rel="stylesheet" href="/assets/style.css">

</head>
<body>

<a href="<?php echo site_url('app/logout') ?>" class="logout">
    <i class="fa fa-sign-out fa-lg"></i> Logout
</a>

    <section>
        <!-- Form -->
        <div>
            <!--
                site_url() è un helper che ci permette di creare l'url in maniera corretta
                app/new_todo è il metodo del controller app che aggiunge un nuovo todo
                va abilitato nell'autoload l'helper "url" e va settato il dominio nel base_url del file config.php, es: http://codeigniter.local/
            -->
            <form method="post" action="<?php echo site_url("app/edit" ); ?>">
                <input type="hidden" name="id" value="<?php echo $todo->id; ?>">
                <input type="text" name="todo" value="<?php echo $todo->text; ?>">
                <button type="submit">Update</button>
            </form>
        </div>
    </section>

</body>
</html>