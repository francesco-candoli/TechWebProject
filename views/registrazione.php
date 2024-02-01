<?php

$form='<h2>Registrazione</h2>
    <hr>
    <div class="text-start">
    <form action="'.PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.'processRegister" method="POST">
        <label for="nickname" class="form-label mt-2 mb-0">Nickname</label>
        <input type="text" class="form-control" id="nickname" name="username">

        <label for="password" class="form-label mt-2 mb-0">Password</label>
        <input type="password" class="form-control" id="password-register" name="password">
                  
        
        <label for="sex" class="form-label mt-2 mb-0">Sex</label>
        <input type="text" class="form-control" id="sex" name="sex">

        <label for="age" class="form-label mt-2 mb-0">Age</label>
        <input type="number" class="form-control" id="age" name="age" value="18">

        <div class="text-center">
            <button type="submit" class="btn btn-outline-primary my-2" id="registerButton">Registrami</button>
            <a href="'.PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.'login" class="text-decoration-none">Login</button>
        </div>
    </form>
</div>';

require 'template/form-template.php';
?>
