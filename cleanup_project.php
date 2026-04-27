<?php

function cleanFile($filePath) {
    if (!file_exists($filePath)) return;
    $content = file_get_contents($filePath);
    
    // Remove PHP multi-line comments
    $content = preg_replace('!/\*.*?\*/!s', '', $content);
    
    // Remove PHP single-line comments (only if they start the line or follow whitespace)
    $content = preg_replace('!^\s*//.*!m', '', $content);
    $content = preg_replace('!^\s*#.*!m', '', $content);
    
    // Remove HTML icons (FontAwesome and IonIcons)
    $content = preg_replace('!<i class="[^"]*(fa|ion)[^"]*"></i>!', '', $content);
    
    // Remove empty lines created by comment removal
    $content = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $content);
    
    file_put_contents($filePath, $content);
}

// List of important directories
$dirs = ['App/Controllers', 'App/models', 'App/views', 'App/Core'];

foreach ($dirs as $dir) {
    $fullDir = __DIR__ . '/' . $dir;
    if (!is_dir($fullDir)) continue;
    
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($fullDir));
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            cleanFile($file->getPathname());
            echo "Cleaned: " . $file->getPathname() . "\n";
        }
    }
}
?>
