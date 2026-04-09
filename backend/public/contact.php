<?php
$file = __DIR__ . '/contact.html';
if (!file_exists($file)) {
    http_response_code(500);
    echo "contact.html niet gevonden";
    exit;
}

$html = file_get_contents($file);
$html = str_replace(
    ['index.html', 'store.html', 'library.html', 'contact.html', 'login.html'],
    ['index.php',  'store.php',  'library.php',  'contact.php',  'login.php'],
    $html
);
$html = preg_replace('/<img[^>]*betere-stoom\\.png[^>]*>\\s*/i', '', $html);

echo $html;

