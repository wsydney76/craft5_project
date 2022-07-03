<?php
echo "Initializing a ddev config.craft.yaml file with a given project handle. \n\n";

$handle = $argv[1] ?? readline('Project handle: ');

$inputFile = './setup/config.craft.yaml';
$outputFile = './.ddev/config.craft.yaml';

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

