<div class="row justify-content-center mt-5">
    <div class="col-md-4">

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <h2 class="fw-bold text-center mb-4">Crear cuenta</h2>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>register">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input 
                            type="text" 
                            name="nombre" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmar contraseña</label>
                        <input 
                            type="password" 
                            name="password_confirm" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <button class="btn btn-primary w-100 mt-3">
                        Registrarme
                    </button>

                </form>

                <div class="text-center mt-3">
                    <a href="<?= BASE_URL ?>login" class="text-decoration-none">
                        ¿Ya tienes cuenta? Inicia sesión
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
