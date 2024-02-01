<?php

$titolo = "Home";
$path=PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER;
$script="
<script src='{$path}public/js/index.js'></script>
<script src='{$path}public/js/comments.js'></script>
<script src='{$path}public/js/likes.js'></script>
<script src='{$path}public/js/slider.js'></script>";

require 'template/base.php';   