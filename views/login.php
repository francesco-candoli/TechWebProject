<?php

$form='
<h2>Login</h2>
<hr>
<div class="text-start">
    <form action="'.PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.'processLogin" method="POST">
        <label for="username" class="form-label mt-2 mb-0">Nickname</label>
        <input type="text" class="form-control border-black" id="username" name="username" required>

        <label for="password" class="form-label mt-2 mb-0">Password</label>
        <input type="password" class="form-control border-black" id="password" name="password" required>

                              
        <div class="text-center">
            <button type="submit" class="btn btn-warning text-dark border-black my-2">Login</button>
            <a href="'.PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.'register" class="text-decoration-none text-black" >Registrazione</a>
        </div>
    </form>
</div>';

require 'template/form-template.php';