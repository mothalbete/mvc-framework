<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <h2 class="fw-bold mb-4">Mi perfil</h2>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre</label>
                    <p class="form-control-plaintext">
                        <?= htmlspecialchars($usuario->nombre) ?>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <p class="form-control-plaintext">
                        <?= htmlspecialchars($usuario->email) ?>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Fecha de registro</label>
                    <p class="form-control-plaintext">
                        <?= htmlspecialchars($usuario->created_at ?? 'No disponible') ?>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Último acceso</label>
                    <p class="form-control-plaintext">
                        <?= htmlspecialchars($usuario->last_login ?? 'No disponible') ?>
                    </p>
                </div>

                <hr>

                <a href="<?= BASE_URL ?>logout" class="btn btn-danger w-100 mt-3">
                    Cerrar sesión
                </a>

            </div>
        </div>

    </div>
</div>
