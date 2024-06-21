<div style="min-height: 100vh;" class="container py-5 mx-auto ">

    <div class="col-md-6 col-sm-12  mx-auto">
        <div class="row">
            <div class=" col-md-6 col=sm-12 ">

            <?php include('components/alert.php');?>


                <p class="fs-2">Minha conta</p>

                <!-- <img class="w-50 mb-3" id="" src="assets/images/top/id_1_top_1708626416327.png" alt=""> -->
                <dl class="row">


                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9"><?= $data['name'] ?></dd>

                    <dt class="col-sm-3">E-mail</dt>
                    <dd class="col-sm-9"><?= $data['email'] ?></dd>

                    <dt class="col-sm-3">Criado em</dt>
                    <dd class="col-sm-9"><?= date('d/m/Y', strtotime($data['created_at'])) ?></dd>



                </dl>


                <a href="?a=edit_account_page" style="width: fit-content;" class="btn btn-warning btn-sm">Editar conta</a>

                <!-- Add swal to this button -->
                <a href="?a=delete_account" style="width: fit-content;" class="btn btn-danger btn-sm">Deletar conta</a>


                <form id="form-delete-account" class="d-none mt-3" action="?a=delete_account" method="POST">

                    <label class="form-label" for="password">Enter your password</label>
                    <input id="password" class="form-control" name="password" type="password" placeholder="password">

                    <div class="mt-2 d-flex gap-2">
                        <button class="btn btn-danger btn-sm " type="submit">Delete account</button>
                        <button class="btn btn-success btn-sm">Cancel</button>
                    </div>
                </form>

            </div>





        </div>
    </div>



</div>