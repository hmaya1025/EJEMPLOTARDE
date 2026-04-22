<?php
// ── PEDIDO.PHP - Procesamiento de pedidos ──

// Solo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// ── SANITIZACIÓN ──
function clean(string $val): string {
    return htmlspecialchars(trim($val), ENT_QUOTES, 'UTF-8');
}

$nombre   = clean($_POST['nombre']   ?? '');
$telefono = clean($_POST['telefono'] ?? '');
$correo   = clean($_POST['correo']   ?? '');
$direccion= clean($_POST['direccion']?? '');
$producto = clean($_POST['producto'] ?? '');
$cantidad = (int) ($_POST['cantidad'] ?? 0);
$mensaje  = clean($_POST['mensaje']  ?? '');

// ── VALIDACIÓN ──
$errores = [];

if (empty($nombre))    $errores[] = 'El nombre es requerido.';
if (empty($telefono))  $errores[] = 'El teléfono es requerido.';
if (empty($correo))    $errores[] = 'El correo es requerido.';
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = 'El correo no es válido.';
if (empty($direccion)) $errores[] = 'La dirección es requerida.';
if (!in_array($producto, ['Pulpa Roja', 'Pulpa Verde', 'Pulpa Amarilla'])) {
    $errores[] = 'Selecciona un producto válido.';
}
if ($cantidad < 1 || $cantidad > 50) $errores[] = 'La cantidad debe estar entre 1 y 50 kg.';

if (!empty($errores)) {
    $msg = urlencode('Error: ' . implode(' ', $errores));
    header("Location: index.php?status=error&msg=$msg");
    exit;
}

// ── ARCHIVO JSON ──
$archivo = __DIR__ . '/pedidos.json';

// Leer pedidos existentes
$pedidos = [];
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    if (!empty($contenido)) {
        $pedidos = json_decode($contenido, true) ?? [];
    }
}

// ── GENERAR ID ÚNICO ──
$ultimo_num = 0;
foreach ($pedidos as $p) {
    if (isset($p['id'])) {
        $num = (int) ltrim(str_replace('VP-', '', $p['id']), '0');
        if ($num > $ultimo_num) $ultimo_num = $num;
    }
}
$nuevo_id = 'VP-' . str_pad($ultimo_num + 1, 4, '0', STR_PAD_LEFT);

// ── NUEVO PEDIDO ──
$nuevo_pedido = [
    'id'          => $nuevo_id,
    'fecha'       => date('Y-m-d H:i:s'),
    'nombre'      => $nombre,
    'telefono'    => $telefono,
    'correo'      => $correo,
    'direccion'   => $direccion,
    'producto'    => $producto,
    'cantidad_kg' => $cantidad,
    'mensaje'     => $mensaje,
    'estado'      => 'pendiente',
];

$pedidos[] = $nuevo_pedido;

// ── GUARDAR ──
$guardado = file_put_contents(
    $archivo,
    json_encode($pedidos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
    LOCK_EX
);

if ($guardado === false) {
    $msg = urlencode('No se pudo guardar el pedido. Intenta nuevamente.');
    header("Location: index.php?status=error&msg=$msg");
    exit;
}

// ── ÉXITO ──
$msg = urlencode("✅ ¡Pedido $nuevo_id recibido, $nombre! Te contactaremos pronto.");
header("Location: index.php?status=ok&msg=$msg");
exit;
