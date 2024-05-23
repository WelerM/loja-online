<div class=" " style="height:fit-content">

    <div class="welcome-container  w-100">

        <form class=" p-4 mx-auto mt-5" style="max-width:500px" action="?a=signup" method="POST">

            <p class="text-center text-success fs-2 mb-4">Create account</p>


            <!-- Name -->
            <div class="mb-3">
                <label for="signup-name" class="form-label">Name</label>

                <input id="signup-name" type="text" name="signup-name" value="weler" class="form-control  " aria-describedby="emailHelp">
            </div>


            <!-- Email -->
            <div class="mb-3">
                <label for="signup-email" class="form-label">Email address</label>

                <input  id="signup-email" type="email" name="signup-email" value="welerson194@gmail.com" class="form-control" aria-describedby="emailHelp">

                <div class="form-text ">We'll never share your email with anyone else.</div>
            </div>


            <!-- Password -->
            <div class="mb-3">

                <label for="signup-password" class="form-label">Senha</label>

                <input id="signup-password"  type="password" name="signup-password" class="form-control   ">

            </div>


            <!-- Repeat Password -->
            <div class="mb-3">

                <label for="signup-repeat-password" class="form-label">Repetir senha</label>

                <input id="signup-repeat-password"  type="password" name="signup-repeat-password" class="form-control   ">

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


            <div class="js-alert-error d-none alert alert-danger"></div>

            <button type="submit" class="btn-register btn btn-success">Registrar</button>

        </form>

    </div>


</div>