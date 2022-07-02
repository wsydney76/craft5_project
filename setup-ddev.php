<?php
echo "Initializing a ddev project Env file with a given project handle. \n\n";

$handle = $argv[1] ?? readline('Project handle: ');

$inputFile = './config/Env.php.ddev.example';
$outputFile = './config/Env.php';

file_put_contents($outputFile, str_replace(
    [
        '$HANDLE$',
        '$UC_HANDLE$',
        '$SECURITY_KEY$'
    ],
    [
        $handle,
        ucfirst($handle),
        bin2hex(random_bytes(32))
    ],
    file_get_contents($inputFile)
));

echo "$outputFile written\n";

