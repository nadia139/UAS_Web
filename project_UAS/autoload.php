<?php
// File: autoload.php (letakkan di folder project_UAS)
spl_autoload_register(function ($class) {
    // List folder yang akan dicek
    $folders = [
        'models/',
        'controllers/',
        'config/'
    ];
    
    foreach ($folders as $folder) {
        $file = __DIR__ . '/' . $folder . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    
    die("Class $class tidak ditemukan");
});
?>