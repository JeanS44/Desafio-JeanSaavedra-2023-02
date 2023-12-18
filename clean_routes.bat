@echo off

:LOOP
REM Ruta al ejecutable de PHP (asegúrate de actualizarla)
set PHP_PATH=C:\php\php.exe

REM Ruta a tu proyecto Laravel (asegúrate de actualizarla)
set LARAVEL_PATH=C:\Users\Jean\Desktop\Desafio-JeanSaavedra-2023-02

REM Ejecuta el comando Artisan
%PHP_PATH% %LARAVEL_PATH%\artisan optimize:clear

REM Espera 1 segundo antes de volver a ejecutar el comando
timeout /nobreak /t 1 >nul

goto LOOP