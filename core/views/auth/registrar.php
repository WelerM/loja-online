<div style="height:100vh" class="container row mx-auto">


    <form class="col-md-6 col-sm-12 mx-auto p-0" style="max-width:500px" action="?a=register" method="POST">

        <p class="text-center text-success  fs-2 mb-4">Registrar</p>

        <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>


        <!-- Name -->
        <div class="mb-3">
            <label for="signup-name" class="form-label">Nome completo</label>

            <input value="ana" id="signup-name" type="text" name="signup-name" placeholder="Nome completo" class="form-control  " aria-describedby="emailHelp">
        </div>


        <!-- Email -->
        <div class="mb-3">
            <label for="signup-email" class="form-label">Seu melhor email</label>

            <input value="welerson25@yahoo.com" id="signup-email" type="email" name="signup-email" placeholder="Seu melhor email" class="form-control" aria-describedby="emailHelp">

            <div class="form-text ">Nós nunca iremos compartilhar seu email.</div>
        </div>


        <!-- Password -->
        <div class="mb-3">

            <label for="signup-password" class="form-label">Senha</label>

            <input id="signup-password" placeholder="Senha" type="password" name="signup-password" class="form-control   ">

        </div>


        <!-- Repeat Password -->
        <div class="mb-3">

            <label for="signup-repeat-password" class="form-label">Repetir senha</label>

            <input id="signup-repeat-password" placeholder="Repetir senha" type="password" name="signup-repeat-password" class="form-control   ">

        </div>




        <div class="js-alert-error d-none alert alert-danger"></div>

        <button type="submit" class="btn-register btn btn-success">Registrar</button>

    </form>


</div>