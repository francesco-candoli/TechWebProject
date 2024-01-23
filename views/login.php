<?php

$form='
<h2>Login</h2>
<hr>
<div class="text-start">
    <form action="'.PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.'processLogin" method="POST">
        <label for="username" class="form-label mt-2 mb-0">Nickname</label>
        <input type="text" class="form-control" id="username" name="username">

        <label for="password" class="form-label mt-2 mb-0">Password</label>
        <input type="password" class="form-control" id="password" name="password">
                              
        <div class="text-center">
            <button type="submit" class="btn btn-outline-primary my-2">Login</button>
            <a href="registrazione.php" class="text-decoration-none" >Registrazione</button>
        </div>
    </form>
</div>';

require 'template/form-template.php';
?>