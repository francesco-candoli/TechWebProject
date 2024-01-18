<?php

$form='<h2>Registrazione</h2>
    <hr>
    <div class="text-start">
    <form action="#" method="POST">
        <label for="emailInput" class="form-label mt-2 mb-0">Indirizzo Email</label>
        <input type="email" class="form-control" id="emailInput">

        <label for="nickname" class="form-label mt-2 mb-0">Nickname</label>
        <input type="text" class="form-control" id="nickname">

        <label for="password" class="form-label mt-2 mb-0">Password</label>
        <input type="password" class="form-control" id="password">
                  
        <div class="text-center">
            <button type="submit" class="btn btn-outline-primary my-2">Registrami</button>
            <a href="login.php" class="text-decoration-none">Login</button>
        </div>
    </form>
</div>';

require 'template/form-template.php';
?>
