<div class="container py-5 vh-100 ">

    <div class="col-6  h-100 ">
        <div class="row">
            <div class=" col-md-6 col=sm-12 ">

                <p class="fs-2">Minha conta</p>

                <!-- <img class="w-50 mb-3" id="" src="assets/images/top/id_1_top_1708626416327.png" alt=""> -->

                <dl class="row">

                    <?php

                    //    echo $data['user_data']['id'];
                    //    echo $data['user_data']['name'];

                    // foreach ($data['user_data'] as $value) {
                    //      echo $value . '<br>'; 
                    // }
                    ?>

                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9"><?= $data['user_data']['name'] ?></dd>

                    <dt class="col-sm-3">E-mail</dt>
                    <dd class="col-sm-9"><?= $data['user_data']['email'] ?></dd>

                    <dt class="col-sm-3">Criado em</dt>
                    <dd class="col-sm-9"><?= date('d/m/Y', strtotime($data['user_data']['created_at'])) ?></dd>



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


            <!-- Minhas perguntas - client view -->
            <div class="col-md-6 col=sm-12      ">
                <p class="fs-2">Minha perguntas (apenas client)</p>

                <?php foreach ($data['user_questions'] as $item) : ?>

                    <div class="border m-1 p-2 rounded-1 d-flex gap-3">
                        <div>

                            <a href="?a=show_product/<?= $item['id'] ?>">
                                <img style="max-width: 60px;" class="img-fluid" src="<?= $item['img_src'] ?>" alt="">
                            </a>

                        </div>

                        <div>
                            <p class="m-0"><?= $item['question'] ?></p>
                            <p class="m-0"><?= $item['created_at'] ?></p>
                        </div>
                    </div>


                <?php endforeach; ?>

            </div>


        </div>
    </div>



</div>