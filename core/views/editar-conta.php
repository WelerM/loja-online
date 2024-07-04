<div class="container row mx-auto py-2">

    <form class="col-md-6 col-sm-12 mx-auto p-0" style="max-width:500px" action="?a=edit_account" method="POST">


        <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>
        <div class="js-alert-error d-none alert alert-danger"></div>


        <p class="text-center text-success fs-2 mb-2">Editar conta</p>


        <!-- Name -->
        <div class="mb-3">
            <label for="signup-name" class="form-label">Nome completo</label>

            <input required value="<?= $data['name'] ?>" id="signup-name" class="input-name form-control" type="text" name="name" placeholder="Nome completo" aria-describedby="emailHelp">
        </div>


        <!-- Email -->
        <div class="mb-3">

            <label for="signup-email" class="form-label">Seu melhor email</label>

            <input required value="<?= $data['email'] ?>" id="signup-email" class="input-email form-control"  name="email" placeholder="Seu melhor email" aria-describedby="emailHelp">

        </div>


        <!-- Old password -->
        <div class="mb-3">

            <label for="signup-password" class="form-label">Senha antiga</label>

            <input required class="input-old-password  form-control   " placeholder="Senha" type="password" name="old-password">

        </div>


        <!-- Password -->
        <div class="mb-3">

            <label for="signup-password" class="form-label">Nova senha</label>

            <input required id="signup-password" class="input-password  form-control   " placeholder="Senha" type="password" name="password">

        </div>


        <!-- Repeat Password -->
        <div class="mb-3">

            <label for="signup-repeat-password" class="form-label">Repetir senha</label>

            <input required id="signup-repeat-password" class="input-repeat-password  form-control" placeholder="Repetir senha" type="password" name="repeat-password">

        </div>

        <button type="submit" class=" btn btn-success">Editar</button>

    </form>

</div>