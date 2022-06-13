@echo off
set /P handle=Enter handle:

composer install --no-dev &&^
php setup-temp.php %handle% &&^
php craft install --interactive=0 --username=admin --password=password  --email=admin@example.com &&^
npm install &&^
php craft queue/listen --verbose
