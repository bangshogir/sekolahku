@echo off
chcp 65001 >nul
color 0A
cls

echo ============================================================
echo   🚀 AUTO DEPLOY — Website MTsN 1 Tanah Bumbu
echo   mtsn1tanahbumbu.sch.id
echo ============================================================
echo.

:: Pastikan git stash bersih
echo [1/4] Memeriksa perubahan lokal...
git status --short
echo.

:: Build aset CSS/JS terbaru
echo [2/4] Membangun aset Tailwind CSS dan JavaScript...
call npm run build
if %errorlevel% neq 0 (
    echo.
    echo [ERROR] Build gagal! Periksa error di atas.
    pause
    exit /b 1
)
echo.

:: Minta pesan commit dari pengguna
echo [3/4] Masukkan pesan perubahan (commit message):
set /p COMMIT_MSG=">> "
if "%COMMIT_MSG%"=="" set COMMIT_MSG=deploy: update %date% %time%

:: Push ke GitHub
echo.
echo [4/4] Mengirim ke GitHub dan men-deploy ke server...
git add .
git commit -m "%COMMIT_MSG%"
git push

if %errorlevel% neq 0 (
    echo.
    echo [PERINGATAN] Push gagal. Mungkin tidak ada perubahan baru.
) else (
    echo.
    echo ============================================================
    echo   ✅ BERHASIL! Website sudah diperbarui secara otomatis.
    echo   Kunjungi: https://mtsn1tanahbumbu.sch.id
    echo ============================================================
)

echo.
pause
