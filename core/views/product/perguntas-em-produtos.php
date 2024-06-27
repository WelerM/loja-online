<div style="min-height: 100vh;" class="container row mx-auto px-1 py-3">

    <div class="col-md-6 col-sm-6 mx-auto ">


        <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>


        <h5 class="mb-3">Perguntas em produtos</h5>

        <!-- Filter text help -->
        <div class="d-flex gap-1 align-items-center">
            <p class="m-0">Filtro</p>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-filter-square border" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                <path d="M6 11.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
            </svg>
        </div>

        <!-- Filtering btns for prodduct messages -->
        <div class="container-btns-filter mt-1 mb-5">
            <a href="?a=perguntas-em-produtos/nao-respondidas" class="btn btn-light border <?= ($data['filter'] === 'nao-respondidas') ? 'active    ' : '' ?>">Não respondidas</a>
            <a href="?a=perguntas-em-produtos/respondidas" class="btn btn-light  border <?= ($data['filter'] === 'respondidas') ? 'active' : '  ' ?>">Respondidas</a>
            <a href="?a=perguntas-em-produtos/deletadas" class="btn btn-light border <?= ($data['filter'] === 'deletadas') ? 'active' : '' ?>">Deletadas</a>

        </div>

        <!-- Product messages loop -->
        <?php if (!empty($data)) : ?>

            <?php foreach ($data as $item) : ?>

                <!--This check is necessary cause the main array '$data' comes with one index that is not array -->
                <?php if (is_array($item)) : ?>

                    <div class="border p-1 my-3 rounded shadow w-100">

                        <div class="p-0 ">

                            <!-- User icon, name and message timestamp -->
                            <div class="d-flex justify-content-between">

                                <div class="d-flex gap-3">
                                    <img style="width:30px; height:30px" src="assets/images/user.png" alt="">
                                    <p><?= $item['user_name'] ?> </p>
                                </div>


                                <p style="font-size:13px">
                                    <?= date('d/m/Y', strtotime($item['message_created_at'])) . ' às ' . date('H:i', strtotime($item['message_created_at'])) . 'h' ?>
                                </p>

                            </div>

                               <!-- User message -->
                            <div class="m-0 px-2">
                                <p><?= $item['product_message'] ?></p>
                            </div>


                              <!-- Product information -->
                            <div class=" d-flex gap-2">

                                <p>Produto: </p>

                                <div>
                                    <p class="fw-bold m-0"><?= $item['product_name'] ?> </p>
                                    <p class="fw-bold m-0"><?= 'R$ ' . number_format($item['product_price'], 2, ',', '.'); ?></p>
                                </div>

                            </div>

                            <!-- Buttons container -->
                            <div style="" class="d-flex gap-2 ps-2 pt-2 mb-2 w-100">

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


                    </div>

                    <!-- Answer -->
                    <?php if (isset($item['answer'])) : ?>
                        <?php if ($item['answer'] != '') : ?>
                            <!-- Answer -->

                            <div style="width:fit-content" class=" d-flex gap-2">

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

                <?php endif ?>

            <?php endforeach; ?>

        <?php else : ?>

            <p class="mt-3">Ainda não há perguntas de usuários</p>

        <?php endif ?>

    </div>



    <div class="offcanvas offcanvas-start p-0" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">

        <div class="offcanvas-header p-1">
            <div class="questions-header-display d-flex gap-1">
                <img style="" class="user-img-icon" src="" alt="">
                <span class="user-name fw-bold"></span>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-1">

            <div style="" class="d-flex flex-column gap-2">

                <ul class="ul-questions p-0">

                </ul>


                <div class="d-flex flex-column gap-1">

                    <form action="?a=answer_question" method="POST">

                        <textarea class="form-control" name="answer" id=""></textarea>

                        <button type="submit" class="btn btn-success btn-sm mt-2">Responder</button>


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