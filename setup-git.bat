@echo off
echo ===============================================
echo    HUDSON FURNISHING - GITHUB SETUP
echo ===============================================
echo.

echo [1/6] Checking Git installation...
git --version
if %errorlevel% neq 0 (
    echo ERROR: Git not found! Please restart PowerShell or add Git to PATH
    pause
    exit /b 1
)

echo.
echo [2/6] Configuring Git (if not already configured)...
git config --global user.name "kimthi-0812" 2>nul
git config --global user.email "kimthi.0812@example.com" 2>nul

echo.
echo [3/6] Initializing Git repository...
git init

echo.
echo [4/6] Adding remote origin...
git remote add origin https://github.com/kimthi-0812/hudson-furnishing.git

echo.
echo [5/6] Adding all files...
git add .

echo.
echo [6/6] Creating initial commit...
git commit -m "Initial commit: Hudson Furnishing Laravel project

- Complete Laravel 10 setup with authentication
- Admin dashboard with product/user management  
- Responsive design with Bootstrap 5
- Database seeders with sample data
- Settings management with tabbed interface
- UX/UI improvements and optimizations"

echo.
echo ===============================================
echo Ready to push to GitHub!
echo Run: git push -u origin main
echo ===============================================
pause
