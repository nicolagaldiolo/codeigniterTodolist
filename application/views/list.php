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
            <form method="post" action="<?php echo site_url('app/new_todo'); ?>">
                <input type="text" name="todo">
                <button type="submit">Save</button>
            </form>

            <?php if( function_exists('validation_errors')) { echo validation_errors(); } ?>
            <!-- se la validazione del form fallisce questa funzione torna un messaggio di errore.
            Altrimenti la funzione non viene nemmeno definita -->


        </div>

        <!-- List -->
        <div>
            <?php if(!empty($todos)) : ?>
            <ul>
                <?php foreach ($todos as $todo) : ?>
                <li class="<?php if($todo->completed){ echo 'done'; }?>">
                    <!-- Check -->
                    <div>
                        <a href="<?php if($todo->completed) { echo site_url("app/uncheck/$todo->id"); }else{ echo site_url("app/check/$todo->id"); } ?>">
                            <?php if($todo->completed) : ?>
                                <i class="fa fa-check"></i>
                            <?php endif; ?>
                        </a>
                    </div>
                    <!-- Todo -->
                    <div>
                        <p><?php echo $todo->text; ?></p>
                    </div>
                    <!-- Actions -->
                    <div>
                        <!-- Modify -->
                        <a href="<?php echo site_url("app/todo/$todo->id"); ?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <!-- Delete -->
                        <!-- Chiamo il metodo destroy_todo del controller app passando l'id da eliminare -->
                        <a href="<?php echo site_url("app/destroy_todo/$todo->id"); ?>">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </li>
                <?php endforeach; ?>

            </ul>
            <?php else: ?>
                <p class="nothing">Nessun elemento disponibile.</p>
            <?php endif; ?>
        </div>
    </section>

</body>
</html>