<div style="min-height:100vh" class="container">


    <form class=" p-4 mx-auto mt-5" style="max-width:500px" action="?a=edit_account" method="POST">



        <?php if (isset($_SESSION['error'])) :  ?>

            <div class='alert alert-danger text-center'>
                <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']) ?>
            </div>

        <?php endif; ?>

        <?php if (isset($_SESSION['success'])) :  ?>

            <div class='alert alert-success text-center'>
                <?= $_SESSION['success'] ?>
                <?php unset($_SESSION['success']) ?>
            </div>

        <?php endif; ?>

        <p class="text-center text-success fs-2 mb-4">Editar conta</p>


        <!-- Name -->
        <div class="mb-3">
            <label for="signup-name" class="form-label">Nome completo</label>

            <input value="<?= $data['name'] ?>" id="signup-name" type="text" name="name" placeholder="Nome completo" class="form-control  " aria-describedby="emailHelp">
        </div>


        <!-- Email -->
        <div class="mb-3">

            <label for="signup-email" class="form-label">Seu melhor email</label>

            <input value="<?= $data['email'] ?>" id="signup-email" type="email" name="email" placeholder="Seu melhor email" class="form-control" aria-describedby="emailHelp">

        </div>


        <!-- Password -->
        <div class="mb-3">

            <label for="signup-password" class="form-label">Nova senha</label>

            <input id="signup-password" placeholder="Senha" type="password" name="password" class="form-control   ">

        </div>


        <!-- Repeat Password -->
        <div class="mb-3">

            <label for="signup-repeat-password" class="form-label">Repetir senha</label>

            <input id="signup-repeat-password" placeholder="Repetir senha" type="password" name="repeat-password" class="form-control   ">

        </div>




        <div class="js-alert-error d-none alert alert-danger"></div>

        <button type="submit" class=" btn btn-success">Editar</button>

    </form>

</div>