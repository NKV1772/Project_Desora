@echo off
echo ========================================
echo  SETUP LARAVEL BACKEND
echo ========================================
echo.

cd /d "%~dp0"

echo [1/4] Generating application key...
php artisan key:generate
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Failed to generate key
    pause
    exit /b 1
)

echo.
echo [2/4] Clearing config cache...
php artisan config:clear
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Failed to clear config
    pause
    exit /b 1
)

echo.
echo [3/4] Testing database connection...
php artisan db:show
if %ERRORLEVEL% NEQ 0 (
    echo WARNING: Database connection test failed
    echo Please check your .env file
)

echo.
echo [4/4] Running migrations...
php artisan migrate
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Migration failed
    pause
    exit /b 1
)

echo.
echo ========================================
echo  SETUP HOAN TAT!
echo ========================================
echo.
echo Tiep theo:
echo - Chay: php artisan serve
echo - Mo: http://localhost:8000
echo.
pause

