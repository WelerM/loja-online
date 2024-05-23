<div class="container py-5 vh-100 ">

    <div class="col-6  h-100 ">
        <div class="row">
            <div class=" col-md-6 col=sm-12 ">

                <p class="fs-2">Minha conta</p>

                <!-- <img class="w-50 mb-3" id="" src="assets/images/top/id_1_top_1708626416327.png" alt=""> -->

                <dl class="row">
                    <?php foreach ($data as $user) : ?>

                        <dt class="col-sm-3">Nome</dt>
                        <dd class="col-sm-9"><?= $user->name ?></dd>

                        <dt class="col-sm-3">E-mail</dt>
                        <dd class="col-sm-9"><?= $user->email ?></dd>

                        <dt class="col-sm-3">Criado em</dt>
                        <dd class="col-sm-9"><?= date('d/m/Y', strtotime($user->created_at)) ?></dd>


                    <?php endforeach; ?>

                </dl>

                <?php if (isset($_SESSION['error'])) : ?>

                    <div class='alert alert-danger text-center'>
                        <?= $_SESSION['error'] ?>
                        <?php unset($_SESSION['error']) ?>
                    </div>

                <?php endif ?>

                <button style="width: fit-content;" class="btn btn-warning btn-sm ">Edit</button>

                <!-- Add swal to this button -->
                <button class="btn-ask-delete-account btn btn-danger btn-sm">Delete account</button>

                <form id="form-delete-account" class="d-none mt-3" action="?a=delete_account" method="POST">

                    <label class="form-label" for="password">Enter your password</label>
                    <input id="password" class="form-control" name="password" type="password" placeholder="password">

                    <div class="mt-2 d-flex gap-2">
                        <button class="btn btn-danger btn-sm " type="submit">Delete account</button>
                        <button class="btn btn-success btn-sm">Cancel</button>
                    </div>
                </form>

            </div>


            <div class="col-md-6 col=sm-12">
                <p class="fs-2">Minha perguntas</p>
                
            </div>
        </div>
    </div>



</div>