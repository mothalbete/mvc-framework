<div class="row justify-content-center">
    <div class="col-md-7">

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <h2 class="fw-bold mb-4">Crear nuevo proyecto</h2>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>proyecto/create">

                    <div class="mb-3">
                        <label class="form-label">Título del proyecto</label>
                        <input 
                            type="text" 
                            name="titulo" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea 
                            name="descripcion" 
                            class="form-control" 
                            rows="4"
                        ></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de inicio</label>
                            <input 
                                type="date" 
                                name="fecha_inicio" 
                                class="form-control"
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de fin</label>
                            <input 
                                type="date" 
                                name="fecha_fin" 
                                class="form-control"
                            >
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 mt-3">
                        Crear proyecto
                    </button>

                </form>

                <a href="<?= BASE_URL ?>proyecto" class="btn btn-link mt-3">
                    ← Volver al listado
                </a>

            </div>
        </div>

    </div>
</div>
