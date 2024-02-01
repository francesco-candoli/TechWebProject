<?php

$titolo = "Notifiche";

$path=PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER;
$script="
<script src='{$path}public/js/index.js'></script>
<script src='{$path}public/js/notification.js'></script>";

require 'template/base.php';
