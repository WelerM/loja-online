<div style="min-height: 100vh;" class="container row mx-auto py-5">

    <div class="col-md-6 col-sm-6 mx-auto">


    <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>


        <h5 class="mb-3">Perguntas em produtos</h5>

        <div class="d-flex gap-2 mb-5">
            <a href="?a=perguntas-em-produtos/nao-respondidas" class="btn btn-warning border ">Não respondidas</a>
            <a href="?a=perguntas-em-produtos/respondidas" class="btn btn-success border">Respondidas</a>
            <a href="?a=perguntas-em-produtos/deletadas" class="btn btn-danger border">Deletadas</a>

        </div>

        <?php if (!empty($data)) : ?>

            <?php foreach ($data as $item) : ?>

                <div style="width: w-100;" class="row border p-0 my-3 rounded shadow">

                    <div class="col-8 border-0 border-end p-0 position-relative">

                        <!-- User information -->
                        <div class="d-flex justify-content-between p-2 pb-0 border-bottom">

                            <div class="d-flex gap-3">
                                <img style="width:30px; height:30px" src="assets/images/user.png" alt="">
                                <p><?= $item['user_name'] ?> </p>
                            </div>


                            <p style="font-size:13px">
                                <?= date('d/m/Y', strtotime($item['message_created_at'])) . ' às ' . date('H:i', strtotime($item['message_created_at'])) . 'h' ?>
                            </p>

                        </div>

                        <!-- User question text -->
                        <div class="m-0 px-2">
                            <p><?= $item['product_message'] ?></p>
                        </div>

                        <!-- Buttons container -->
                        <div style="height: fit-content;" class="d-flex gap-2 ps-2 pt-2 mb-2 border-top w-100 position-absolute bottom-0">

                            <?php if ($item['product_message_active'] === '1') : ?>

                                <button name="<?= $item['product_message_id'] ?>" class=" btn-ver-chat btn btn-success btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                    Responder
                                </button>

                            <?php endif ?>


                            <?php if ($item['product_deleted'] === NULL) : ?>

                                <a href="?a=delete-product-question/<?= $item['product_message_id'] ?>" class="btn-delete-product-question btn btn-danger btn-sm">Excluir</a>

                            <?php endif ?>



                        </div>

                    </div>

                    <div class="col-auto p-3">
                        <p>Produto</p>
                        <img src="<?= $item['img_src'] ?>" class="img-fluid" style="max-width: 60px; height: 60px" alt="">
                        <h5 class="card-title"><?= $item['product_name']; ?> </h5>
                        <p class="card-title"><?= 'R$ ' . $item['product_price']; ?> </p>
                    </div>

                </div>

                <!-- Answer -->
                <?php if (isset($item['answer'])) : ?>
                    <?php if ($item['answer'] != '') : ?>
                        <!-- Answer -->

                        <div style="width:fit-content" class="d-flex gap-2">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#909090" class="bi bi-arrow-return-right mt-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5" />
                            </svg>

                            <div class="border rounded shadow-sm p-2">

                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <p class="m-0 me-3"><?= APP_NAME ?></p>
                                    <p style="font-size:13px" class="m-0"><?= date('d/m/Y', strtotime($item['answer_created_at'])) . ' às ' . date('H:i', strtotime($item['answer_created_at'])) . 'h' ?></p>
                                </div>

                                <p class="m-0 "><?= $item['answer']; ?></p>
                            </div>

                        </div>
                    <?php endif ?>
                <?php endif ?>

            <?php endforeach; ?>

        <?php else : ?>

            <p class="mt-3">Ainda não há perguntas de usuários</p>

        <?php endif ?>

    </div>



    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">

            <div class="questions-header-display d-flex gap-1">
                <img style="" class="user-img-icon" src="" alt="">
                <span class="user-name fw-bold"></span>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">

            <div style="" class="d-flex flex-column gap-2">

                <ul class="ul-questions p-0">

                </ul>


                <div class="d-flex flex-column gap-1">

                    <form action="?a=answer_question" method="POST">

                        <textarea class="form-control" name="answer" id=""></textarea>

                        <button type="submit" class="btn btn-success btn-sm">Responder</button>


                        <!-- Hidden -->
                        <input class="product-message-id d-none" name="product-message-id" type="text">

                        <!-- Hidden -->
                        <input class="product-id d-none" name="product_id" value="" type="text">

                        <!-- Hidden -->
                        <input class="product-user-id d-none" name="user_id" value="" type="text">

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>