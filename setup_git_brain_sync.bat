@echo off
setlocal enabledelayedexpansion

echo ==============================================
echo Antigravity Git Brain Sync Setup
echo ==============================================
echo.
echo This script links your global Antigravity brain
echo to this Git repository so you can push/pull chat logs.
echo.
echo Please ensure Antigravity IDE is CLOSED before continuing!
echo.
pause

set "GLOBAL_BRAIN_DIR=%USERPROFILE%\.gemini\antigravity-ide\brain"
set "CONV_ID=1bc2240c-9d09-485c-a3c3-8e750744a6fc"
set "LOCAL_LINK=%GLOBAL_BRAIN_DIR%\%CONV_ID%"
set "TARGET_DIR=%~dp0.gemini\brain\%CONV_ID%"

:: Create parent directory if not exist
if not exist "%GLOBAL_BRAIN_DIR%" (
    mkdir "%GLOBAL_BRAIN_DIR%"
)

:: If the link or folder already exists, delete/rename it
if exist "%LOCAL_LINK%" (
    echo A local chat history folder was found at:
    echo %LOCAL_LINK%
    echo.
    set /p "CHOICE=Do you want to backup and replace it? (y/n): "
    if /i "!CHOICE!"=="y" (
        echo Backing up to %LOCAL_LINK%_old ...
        move "%LOCAL_LINK%" "%LOCAL_LINK%_old"
    ) else (
        echo Cancelled.
        pause
        exit /b
    )
)

echo Creating symbolic link...
mklink /d "%LOCAL_LINK%" "%TARGET_DIR%"

if %errorlevel% equ 0 (
    echo.
    echo Success! The chat brain is now linked to this repository.
    echo You can now commit and push the '.gemini/' directory.
) else (
    echo.
    echo ERROR: Failed to create symbolic link. 
    echo Make sure you ran this script as Administrator.
)
echo.
pause
