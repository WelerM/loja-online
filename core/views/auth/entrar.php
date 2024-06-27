<div style=" min-height: 100vh;" class="container row mx-auto" >


        <form class="col-md-6 col-sm-12 mx-auto p-0" style="max-width: 400px;"  action="?a=login" method="POST">


            <p class="text-center text-success  fs-2 mb-4">Entrar</p>

            <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>


            <!-- Email  add 'required' attribute-->
            <div class="mb-3">

                <label for="login-email" class="form-label">Email</label>

                <input  id="login-email" class="input-email form-control" value="welerson194@gmail.com" required type="email" name="login-email"  aria-describedby="emailHelp">


            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          

            <!-- Password add 'required' attribute -->
            <div class="mb-3">

                <label for="login-password" class="form-label">Senha</label>

                <input id="login-password" class="form-control bg-transparent" type="password" name="login-password"  >

            </div>




            <div class="mb-3 d-flex justify-content-between">
                <div class='d-none alert js-alert-error alert-danger text-center'></div>
                <a class="text-dark fs-6    " href="?a=recuperar-senha">Esqueceu sua senha?</a>
                <a class="text-dark fs-6    " href="?a=registrar">Criar conta</a>
            </div>


            <button type="submit" class="btn btn-login btn-success">Entrar</button>

        </form>



</div>