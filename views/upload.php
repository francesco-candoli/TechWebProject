<?php

$form='
<div class="text-center">
    <h2>Recensione</h2>
</div>
<hr>
<div class="text-start">
    <form action="'.PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.'processUpload" method="POST" enctype="multipart/form-data">
        <label for="ristorante" class="form-label mt-2 mb-0">Nome Ristorante</label>
        <input type="text" class="form-control border-black" id="ristorante" name="ristorante" required>

        <label for="content" class="form-label mt-2 mb-0">Recensione</label>
        <input type="text" class="form-control border-black" id="content" name="content" required>

        <label for="vote">Voto</label>
        <input type="number" class="my-2" id="vote" name="vote" min="0" max="5" required/><br>

        <label for="fileup">Upload File:</label> <input type="file" name="fileup[]" id="fileup" multiple="multiple" required/><br>
        <label for="fileup2">Upload File:</label> <input type="file" name="fileup[]" id="fileup2" multiple="multiple"/><br>
        <label for="fileup3">Upload File:</label> <input type="file" name="fileup[]" id="fileup3" multiple="multiple"/><br>
        <label for="fileup4">Upload File:</label> <input type="file" name="fileup[]" id="fileup4" multiple="multiple"/><br>
        <label for="fileup5">Upload File:</label> <input type="file" name="fileup[]" id="fileup5" multiple="multiple"/>

        <div class="text-center">
            <button type="submit" class="btn btn-info text-dark border-black my-2">Carica</button>
        </div>
    </form>
</div>';

require 'template/base.php';