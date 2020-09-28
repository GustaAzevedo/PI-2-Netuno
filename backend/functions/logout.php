<?php
session_start();
session_destroy();
header('Location: ../../web/src/views/pg-login.html');
exit();