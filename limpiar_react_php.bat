@echo off
echo 🧹 Limpiando archivos innecesarios del proyecto...

REM === Eliminar archivos del build de Vite ya copiados ===
IF EXIST "public\react\index.html" (
    del /q "public\react\index.html"
    echo ✅ Eliminado: public\react\index.html
)

IF EXIST "public\react\vite.svg" (
    del /q "public\react\vite.svg"
    echo ✅ Eliminado: public\react\vite.svg
)

REM === Limpiar archivos de desarrollo dentro de react-app ===
IF EXIST "react-app\dist" (
    rmdir /s /q "react-app\dist"
    echo ✅ Eliminado: react-app\dist
)

IF EXIST "react-app\public" (
    rmdir /s /q "react-app\public"
    echo ✅ Eliminado: react-app\public
)

IF EXIST "react-app\index.html" (
    del /q "react-app\index.html"
    echo ✅ Eliminado: react-app\index.html
)


echo 🧼 Limpieza finalizada.
pause
