<?php

require __DIR__ . '/_bootstrap.php';

unset($_SESSION['user']);
session_regenerate_id(true);

redirect('/index.php');

