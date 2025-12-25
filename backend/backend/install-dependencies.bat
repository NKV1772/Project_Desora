@echo off
echo ========================================
echo  CAI DAT DEPENDENCIES CHO LARAVEL
echo ========================================
echo.
echo QUAN TRONG: Can tat Avast Firewall tam thoi!
echo.
echo Buoc 1: Mo Avast
echo Buoc 2: Tat Firewall (5-10 phut)
echo Buoc 3: Nhan Enter de tiep tuc...
echo.
pause

cd /d "%~dp0"
echo.
echo Dang chay composer install...
"C:\tools\php84\composer.bat" install --no-interaction

if %ERRORLEVEL% EQU 0 (
    echo.
    echo ========================================
    echo  CAI DAT THANH CONG!
    echo ========================================
    echo.
    echo Tiep theo:
    echo 1. php artisan key:generate
    echo 2. php artisan config:clear
    echo 3. php artisan db:show
    echo 4. php artisan migrate
) else (
    echo.
    echo ========================================
    echo  LOI! Vui long kiem tra:
    echo ========================================
    echo 1. Avast Firewall da tat chua?
    echo 2. Ket noi internet co on dinh khong?
    echo 3. Thu chay lai script nay
)

pause

