<div style="min-height: 100vh;" class="container  py-5">


    <div class="row">


        <div class="col-sm-12 col-md-6">
            <div style="height:fit-content; width:fit-content" class="card  ">
                <img style=" max-width:200px" src="<?= $data['product_img_src']; ?>" class="card-img-top img-fluid"
                    alt="...">

                <div class="card-body">
                    <h5 class="card-title"><?= $data['product_name']; ?> </h5>
                    <p class="card-title"><?= 'R$ ' . $data['product_price']; ?> </p>
                    <p class="card-text"> <?= $data['product_description']; ?></p>
                    <a href="#" class=""><?= $data['product_link']; ?></a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <h2>perguntas(client view)</h2>

            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="mt-3 ">

                    <form class="flex-column px-0 mb-5 py-1  "
                        action="?a=make_question&product_id=<?= $data['product_id']; ?>" method="POST">

                        <!-- Product description-->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="question-text" placeholder="Leave a comment here"
                                id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Fazer pergunta (clinet view)</label>
                        </div>


                        <button id="btn-form-submit" type="submit" name="submit"
                            class="btn btn-success mx-0 d-flex align-items-center justify-content-center"
                            style="width: fit-content;">

                            Enviar</button>

                    </form>

                </div>

            <?php else: ?>
                <a href="?a=login_page">
                    <div class="alert alert-light">
                        Crie uma conta para fazer perguntas
                    </div>
                </a>
            <?php endif; ?>


            <?php if (isset($data['product_messages']) && $data['product_messages'] != null): ?>

                <?php foreach ($data['product_messages'] as $questions): ?>

                    <div class="border my-2 py-2 px-2 rounded-1 ">
                        <p class="mb-1"><?= $questions['user_name']; ?></p>
                        <p class="m-0"><?= $questions['user_question']; ?></p>
                        <p style="" class="m-0 P-0 text-end">
                            <?= (new DateTime($questions['question_created_at']))->format('d-m-Y'); ?>
                        </p>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p>Não há perguntas ainda</p>

            <?php endif; ?>





        </div>
    </div>
</div>