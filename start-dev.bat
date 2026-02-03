@echo off
echo Starting SIMPUR System...

:: Start Backend
echo Launching Backend (Port 8000)...
start "SIMPUR Backend" cmd /k "cd backend && php artisan serve --port=8000"

:: Start Frontend
echo Launching Frontend (Port 8080)...
start "SIMPUR Frontend" cmd /k "cd frontend && php artisan serve --port=8080"

echo.
echo ===================================================
echo  System Started!
echo  Backend API : http://127.0.0.1:8000
echo  Frontend UI : http://127.0.0.1:8080
echo.
echo  * Halaman Login Admin: http://127.0.0.1:8080/login
echo  * Cek Terminal jika ada error.
echo ===================================================
pause
