<div style=" min-height: 100vh;" class="py-5 row mx-auto" >

    <div class="col-md-6 col-sm-12 mx-auto">

        <form class="login-form p-4  d-flez flex-column mx-auto" style="max-width: 400px;"  action="?a=login" method="POST">


            <p class="text-center text-success  fs-2 mb-4">Entrar</p>


            <!-- Email -->
            <div class="mb-3">

                <label for="login-email" class="form-label">Email</label>

                <input value="welerson194@gmail.com" required type="email" name="login-email" class="form-control" id="login-email" aria-describedby="emailHelp">


            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          

            <!-- Password -->
            <div class="mb-3">

                <label for="login-password" class="form-label">Senha</label>

                <input  required type="password" name="login-password" class="form-control bg-transparent " id="login-password">

            </div>


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

            <div class="mb-3 d-flex justify-content-between">
                <div class='d-none alert js-alert-error alert-danger text-center'></div>
                <a class="text-dark fs-6    " href="?a=send_recovery_email_page">Esqueceu sua senha?</a>
                <a class="text-dark fs-6    " href="?a=register_page">Criar conta</a>
            </div>


            <button type="submit" class="btn btn-login btn-success">Entrar</button>

        </form>

    </div>


</div>