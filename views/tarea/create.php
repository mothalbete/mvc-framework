<?php
// Si viene desde un proyecto, ocultamos el selector
$ocultarSelector = !empty($proyectoSeleccionado);
?>

<?php if ($ocultarSelector): ?>

    <!-- Proyecto preseleccionado y oculto -->
    <input type="hidden" name="proyecto_id" value="<?= $proyectoSeleccionado ?>">

    <div class="alert alert-info">
        Creando tarea para el proyecto:
        <strong>
            <?= htmlspecialchars(
                $proyectos->firstWhere('proyecto_id', $proyectoSeleccionado)->titulo 
                ?? 'Proyecto desconocido'
            ) ?>
        </strong>
    </div>

<?php else: ?>

    <!-- Selector visible si NO viene desde un proyecto -->
    <div class="mb-3">
        <label class="form-label">Proyecto</label>
        <select name="proyecto_id" class="form-select" required>
            <option value="">Selecciona un proyecto</option>

            <?php foreach ($proyectos as $proyecto): ?>
                <option value="<?= $proyecto->proyecto_id ?>">
                    <?= htmlspecialchars($proyecto->titulo) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

<?php endif; ?>
