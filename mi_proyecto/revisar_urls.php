<?php
// Ruta raíz del proyecto (ajustar si lo ponés en otra carpeta)
$root = __DIR__;

// Extensiones a revisar
$extensiones = ['php', 'html', 'js', 'css', 'jsx'];

// Contador de coincidencias
$total = 0;

echo "<pre>";
echo "🔍 Buscando 'http://localhost' en archivos del proyecto...\n\n";

// Recorrido recursivo de carpetas
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));

foreach ($rii as $file) {
    if ($file->isDir()) continue;

    $ext = pathinfo($file->getPathname(), PATHINFO_EXTENSION);
    if (!in_array($ext, $extensiones)) continue;

    $lineas = file($file->getPathname());
    foreach ($lineas as $num => $linea) {
        if (strpos($linea, 'http://localhost') !== false) {
            $relPath = str_replace($root . '/', '', $file->getPathname());
            echo "📁 $relPath (Línea " . ($num + 1) . "):\n";
            echo "   " . trim($linea) . "\n\n";
            $total++;
        }
    }
}

if ($total === 0) {
    echo "✅ No se encontraron rutas con http://localhost\n";
} else {
    echo "🔧 Total de coincidencias encontradas: $total\n";
}
echo "</pre>";
?>
