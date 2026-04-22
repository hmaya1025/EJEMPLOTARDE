<?php
// ── ALERTA DE ESTADO (resultado del formulario) ──
$status  = $_GET['status']  ?? '';
$msg_ok  = urldecode($_GET['msg'] ?? '');
?>
<?php include 'includes/header.php'; ?>

<!-- ── ALERTA ── -->
<?php if ($status === 'ok'): ?>
<div class="alert alert-success" role="alert">
  <span>✅</span>
  <span><?php echo htmlspecialchars($msg_ok ?: '¡Pedido registrado! Nos contactaremos pronto.'); ?></span>
  <button class="alert-close" aria-label="Cerrar">✕</button>
</div>
<?php elseif ($status === 'error'): ?>
<div class="alert alert-error" role="alert">
  <span>⚠️</span>
  <span><?php echo htmlspecialchars($msg_ok ?: 'Hubo un error. Por favor intenta de nuevo.'); ?></span>
  <button class="alert-close" aria-label="Cerrar">✕</button>
</div>
<?php endif; ?>

<!-- ════════════════════════════════════
     HERO
════════════════════════════════════ -->
<section class="hero" id="inicio">
  <div class="blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>
  <div class="hero-content">
    <div class="hero-badge">🌱 100% Natural · Sin conservantes</div>
    <h1>Naturaleza en<br><em>cada sorbo</em></h1>
    <p>Pulpas de frutas seleccionadas, congeladas al instante para preservar cada vitamina, mineral y sabor. Tu salud, nuestra misión.</p>
    <div class="hero-btns">
      <a href="#productos" class="btn-primary">🍓 Ver Productos</a>
      <a href="#pedido" class="btn-secondary">📦 Hacer un Pedido</a>
    </div>
    <div class="hero-frutas">
      <span>🍓</span>
      <span>🥝</span>
      <span>🥭</span>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════
     PRODUCTOS
════════════════════════════════════ -->
<section id="productos">
  <div class="container">
    <div class="section-header text-center reveal">
      <span class="section-tag">Nuestras Pulpas</span>
      <h2 class="section-title">Tres colores, tres poderes</h2>
      <p class="section-sub">Cada pulpa es una fuente concentrada de nutrientes, elaborada con frutas frescas de la más alta calidad.</p>
    </div>

    <?php
    $productos = [
      [
        'clase'    => 'card-roja',
        'emoji'    => '🍓',
        'nombre'   => 'Pulpa Roja',
        'subtitulo'=> 'Fresa · Mora · Frambuesa',
        'desc'     => 'Explosión de antioxidantes naturales con el poder de los frutos rojos del bosque. Sabor intenso y color vibrante en cada sorbo.',
        'beneficios' => [
          'Rica en <strong>vitamina C</strong>: refuerza el sistema inmunológico y favorece la absorción del hierro',
          'Alto poder <strong>antioxidante</strong>: los polifenoles y antocianinas combaten el envejecimiento celular',
          'Alto contenido en <strong>fibra</strong>: mejora el tránsito intestinal y controla el colesterol',
          '<strong>Baja en calorías</strong>: solo 30–50 kcal por 100g, ideal para control de peso',
          'Protección <strong>cardiovascular</strong>: los taninos y flavonoides cuidan el corazón',
        ],
        'uso'    => '🥤 Batidos · Bowls de desayuno · Postres naturales',
        'selector' => 'Pulpa Roja',
      ],
      [
        'clase'    => 'card-verde',
        'emoji'    => '🥝',
        'nombre'   => 'Pulpa Verde',
        'subtitulo'=> 'Kiwi · Aguacate · Espinaca',
        'desc'     => 'La energía de lo verde concentrada en una pulpa fresca y revitalizante. El equilibrio perfecto entre nutrición y sabor.',
        'beneficios' => [
          '<strong>Kiwi</strong>: duplica la vitamina C de la fresa; aporta vitamina E, potasio y ácido fólico esencial',
          '<strong>Luteína y zeaxantina</strong>: antioxidantes que protegen activamente la salud visual',
          '<strong>Aguacate</strong>: grasas monoinsaturadas (ácido oleico) que reducen el colesterol LDL',
          'Estimula la <strong>producción de colágeno</strong> y mejora elasticidad de la piel',
          'Excelente fuente de <strong>energía natural</strong> con vitaminas del complejo B',
        ],
        'uso'    => '🥗 Smoothies verdes · Guacamole · Salsas saludables',
        'selector' => 'Pulpa Verde',
      ],
      [
        'clase'    => 'card-amarilla',
        'emoji'    => '🥭',
        'nombre'   => 'Pulpa Amarilla',
        'subtitulo'=> 'Maracuyá · Mango · Piña',
        'desc'     => 'Sabor tropical que cuida tu cuerpo desde adentro. Una mezcla exótica cargada de enzimas, vitaminas y antioxidantes únicos.',
        'beneficios' => [
          '<strong>Maracuyá</strong>: más antioxidantes que el mango, la piña o la papaya; calma la ansiedad naturalmente',
          '<strong>Mango</strong>: aporta el 75% de vitamina C diaria en solo ½ taza; vitamina A para piel y visión',
          '<strong>Bromelina de piña</strong>: enzima antiinflamatoria y digestiva; diurético natural',
          '7g de <strong>fibra por 100g</strong> de pulpa: regula el intestino y reduce el colesterol',
          '<strong>Bajo índice glucémico</strong>: adecuado para personas con control de azúcar',
        ],
        'uso'    => '🍹 Jugos tropicales · Helados naturales · Marinadas',
        'selector' => 'Pulpa Amarilla',
      ],
    ];
    ?>

    <div class="productos-grid">
      <?php foreach ($productos as $i => $p): ?>
      <div class="producto-card <?php echo $p['clase']; ?> reveal reveal-d<?php echo $i+1; ?>">
        <div class="card-header">
          <span class="card-emoji"><?php echo $p['emoji']; ?></span>
          <div class="card-nombre"><?php echo $p['nombre']; ?></div>
          <div class="card-subtitulo"><?php echo $p['subtitulo']; ?></div>
        </div>
        <div class="card-body">
          <p class="card-desc"><?php echo $p['desc']; ?></p>
          <ul class="beneficios-lista">
            <?php foreach ($p['beneficios'] as $b): ?>
            <li>
              <span class="check">✓</span>
              <span><?php echo $b; ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
          <div class="card-uso"><?php echo $p['uso']; ?></div>
          <button class="btn-card" data-producto="<?php echo htmlspecialchars($p['selector']); ?>">
            Pedir <?php echo $p['nombre']; ?> →
          </button>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════
     POR QUÉ VITALPULP
════════════════════════════════════ -->
<section id="porque">
  <div class="container">
    <div class="section-header text-center reveal">
      <span class="section-tag">Nuestra Diferencia</span>
      <h2 class="section-title">¿Por qué elegir VitalPulp?</h2>
      <p class="section-sub">No somos solo pulpa. Somos un compromiso con tu salud y la naturaleza.</p>
    </div>

    <?php
    $razones = [
      ['🌿','100% Natural','Sin conservantes, sin colorantes artificiales. Solo fruta pura y fresca en cada bolsa.'],
      ['❄️','Congelación inmediata','Congelamos en las primeras horas tras la cosecha para preservar cada vitamina y mineral.'],
      ['🚚','Entrega a domicilio','Llevamos tu pedido directo a tu puerta en perfectas condiciones de frío.'],
      ['🔬','Calidad certificada','Procesos rigurosos de higiene y control de calidad en cada lote de producción.'],
      ['♻️','Empaque sostenible','Usamos envases reciclables y reducimos nuestra huella de carbono en cada etapa.'],
      ['💚','Apoyo local','Trabajamos directamente con agricultores colombianos para garantizar la frescura.'],
    ];
    ?>

    <div class="porque-grid">
      <?php foreach ($razones as $i => $r): ?>
      <div class="porque-item reveal reveal-d<?php echo ($i % 4) + 1; ?>">
        <span class="porque-icon"><?php echo $r[0]; ?></span>
        <h3><?php echo $r[1]; ?></h3>
        <p><?php echo $r[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════
     FORMULARIO DE PEDIDO
════════════════════════════════════ -->
<section id="pedido">
  <div class="container">
    <div class="pedido-wrapper">

      <!-- Info lateral -->
      <div class="pedido-info reveal">
        <span class="section-tag">Haz tu pedido</span>
        <h2>Recibe tu pulpa<br><em>en casa</em></h2>
        <p>Llena el formulario y uno de nuestros asesores te contactará en menos de 24 horas para confirmar tu pedido y coordinar la entrega.</p>
        <div class="pedido-pasos">
          <div class="paso">
            <div class="paso-num">1</div>
            <div class="paso-txt">
              <strong>Completa el formulario</strong>
              Ingresa tus datos y el producto que deseas
            </div>
          </div>
          <div class="paso">
            <div class="paso-num">2</div>
            <div class="paso-txt">
              <strong>Te confirmamos el pedido</strong>
              Te llamamos o escribimos para confirmar detalles
            </div>
          </div>
          <div class="paso">
            <div class="paso-num">3</div>
            <div class="paso-txt">
              <strong>Recibe en la puerta de tu casa</strong>
              Entregamos en cadena de frío para máxima frescura
            </div>
          </div>
        </div>
      </div>

      <!-- Formulario -->
      <div class="form-card reveal reveal-d2">
        <form action="pedido.php" method="POST" id="pedidoForm" novalidate>

          <div class="form-row">
            <div class="form-group">
              <label for="nombre">👤 Nombre completo *</label>
              <input type="text" id="nombre" name="nombre" placeholder="Juan Pérez" required maxlength="100">
            </div>
            <div class="form-group">
              <label for="telefono">📞 Teléfono *</label>
              <input type="tel" id="telefono" name="telefono" placeholder="300 123 4567" required maxlength="20">
            </div>
          </div>

          <div class="form-group">
            <label for="correo">📧 Correo electrónico *</label>
            <input type="email" id="correo" name="correo" placeholder="juan@correo.com" required maxlength="150">
          </div>

          <div class="form-group">
            <label for="direccion">📍 Dirección de entrega *</label>
            <textarea id="direccion" name="direccion" placeholder="Calle 45 #12-34, Barrio Centro, Bogotá" required maxlength="300"></textarea>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="producto">🍓 Producto *</label>
              <select id="producto" name="producto" required>
                <option value="" disabled selected>Selecciona...</option>
                <option value="Pulpa Roja">🍓 Pulpa Roja</option>
                <option value="Pulpa Verde">🥝 Pulpa Verde</option>
                <option value="Pulpa Amarilla">🥭 Pulpa Amarilla</option>
              </select>
            </div>
            <div class="form-group">
              <label for="cantidad">⚖️ Cantidad (kg) *</label>
              <input type="number" id="cantidad" name="cantidad" placeholder="1" min="1" max="50" required>
            </div>
          </div>

          <div class="form-group">
            <label for="mensaje">💬 Mensaje adicional (opcional)</label>
            <textarea id="mensaje" name="mensaje" placeholder="¿Alguna preferencia, alergia o indicación especial?" maxlength="500"></textarea>
          </div>

          <button type="submit" class="btn-submit">
            🛒 Enviar Pedido
          </button>

        </form>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
