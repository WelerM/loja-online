<div style="min-height: 100vh;" class="container  py-5">


    <div class="pt-5">


        <div style="height:fit-content;" class=" row mb-5">

            <div class="col-md-6 col-sm-12 d-flex ">
                <img class="img-fluid mx-auto" style=" max-width:300px" src="<?= $data['product_details']['img_src']; ?>" alt="...">
            </div>

            <div class="col-md-6 col-sm-12">
                <h1 class=""><?= $data['product_details']['name']; ?> </h1>
                <p class="fs-4"><?= $data['product_details']['price']; ?> </p>
                <p class=""> <?= $data['product_details']['description']; ?></p>
                <a href="#" class=""><?= $data['product_details']['link']; ?></a>
            </div>

        </div>


        <div class="">
            <h3>perguntas(client view)</h3>

            <?php if (isset($_SESSION['user_id'])) : ?>
                <div class="mt-3 ">

                    <form class="flex-column px-0 mb-5 py-1  " action="?a=make_question&product_id=<?= $data['product_details']['id']; ?>" method="POST">

                        <!-- Product description-->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="question-text" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Fazer pergunta (clinet view)</label>
                        </div>


                        <button id="btn-form-submit" type="submit" name="submit" class="btn btn-success mx-0 d-flex align-items-center justify-content-center" style="width: fit-content;">

                            Enviar</button>

                    </form>

                </div>

            <?php else : ?>
                <a href="?a=login_page">
                    <div class="alert alert-light">
                        Crie uma conta para fazer perguntas
                    </div>
                </a>
            <?php endif; ?>


            <?php if (isset($data['product_messages']) && $data['product_messages'] != null) : ?>


                <?php foreach ($data['product_messages'] as $data) : ?>


                    <div class="border my-2 py-2 px-2 rounded-1 ">
                        <p class="mb-1"><?= $data['name']; ?></p>

                        <p class="m-0"><?= $data['message']; ?></p>
                        <p style="" class="m-0 p-0 text-end">
                            <?= (new DateTime($data['message_created_at']))->format('d-m-Y'); ?>
                        </p>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <p>Não há perguntas ainda</p>

            <?php endif; ?>





        </div>
    </div>
</div>