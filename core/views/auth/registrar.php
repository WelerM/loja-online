<div style="height:100vh" class="container row mx-auto">


    <form class="col-md-6 col-sm-12 mx-auto p-0" style="max-width:500px" action="?a=register" method="POST">

        <p class="text-center text-success  fs-2 mb-4">Registrar</p>

        <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>
        <div class="js-alert-error d-none alert alert-danger"></div>


        <!-- Name add 'required' attribute -->
        <div class="mb-3">
            <label for="signup-name" class="form-label">Nome completo</label>

            <input id="signup-name" class="input-name form-control" value="ana" name="signup-name" type="text" placeholder="Nome completo" aria-describedby="emailHelp">
        </div>


        <!-- Email add 'required' attribute -->
        <div class="mb-3">
            <label for="signup-email" class="form-label">Seu melhor email</label>

            <input id="signup-email" class="input-email form-control" type="email" name="signup-email" value="welerson25@yahoo.com" placeholder="Seu melhor email" aria-describedby="emailHelp">

            <div class="form-text ">Nós nunca iremos compartilhar seu email.</div>
        </div>


        <!-- Password add 'required' attribute -->
        <div class="mb-3">

            <label for="signup-password" class="form-label">Senha</label>

            <input id="signup-password" class="input-password form-control" placeholder="Senha" type="password" name="signup-password">

        </div>


        <!-- Repeat Password add 'required' attribute -->
        <div class="mb-3">

            <label for="signup-repeat-password" class="form-label">Repetir senha</label>

            <input id="signup-repeat-password" class="input-repeat-password form-control" placeholder="Repetir senha" type="password" name="signup-repeat-password">

        </div>

        <button type="submit" class="btn-register btn btn-success">Registrar</button>

    </form>


</div>