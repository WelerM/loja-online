<div class="container row  mx-auto px-1 py-3">

    <div class="col-md-6 col-sm-12 mx-auto p-0">

        <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>


        <h5>Mensagens de usuários</h5>

        <!-- Filter text help -->
        <div class="d-flex gap-1 align-items-center">

            <p class="m-0">Filtro</p>

            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-filter-square border" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                <path d="M6 11.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
            </svg>
            
        </div>

        <!-- Filtering btns for prodduct messages -->
        <div class="container-btns-filter mt-1 mb-3">
            
            <a href="?a=mensagens-de-usuarios/nao-respondidas" class="btn btn-light border  <?= ($data['filter'] === 'nao-respondidas') ? 'active    ' : '' ?>">Não respondidas</a>
            
            <a href="?a=mensagens-de-usuarios/respondidas" class="btn btn-light  border <?= ($data['filter'] === 'respondidas') ? 'active' : '  ' ?>">Respondidas</a>

            <a href="?a=mensagens-de-usuarios/deletadas" class="btn btn-light border <?= ($data['filter'] === 'deletadas') ? 'active' : '' ?>">Deletadas</a>

        </div>


        <?php if (!empty($data)) : ?>



            <?php foreach ($data as $message) : ?>

                <?php if (is_array($message)) : ?>

                    <!-- User message -->
                    <div class="border p-1 my-3 rounded shadow w-100">

                        <!-- User icon, name and message timestamp -->
                        <div class="d-flex justify-content-between">

                            <div class="d-flex gap-3">
                                <img style="width:30px; height:30px" src="assets/images/user.png" alt="">
                                <p><?= $message['user_name'] ?> </p>
                            </div>


                            <p style="font-size:13px">
                                <?= date('d/m/Y', strtotime($message['message_created_at'])) . ' às ' . date('H:i', strtotime($message['message_created_at'])) . 'h' ?>
                            </p>

                        </div>

                        <!-- User message -->
                        <div class="bg-white py-2 bg-body-tertiary border px-1">
                            <p><?= $message['user_message'] ?></p>
                        </div>

                        <!-- Product information -->
                        <div class=" d-flex gap-2">

                            <p>Produto: </p>

                            <div>
                                <p class="fw-bold m-0"><?= $message['product_name'] ?> </p>
                                <p class="fw-bold m-0"><?= 'R$ ' . number_format($message['product_price'], 2, ',', '.'); ?></p>
                            </div>

                        </div>

                        <!-- Btns container text -->
                        <div style="height: fit-content;" class="d-flex gap-1 mt-2  ">

                            <?php if ($message['user_message_active'] === '1') : ?>

                                <a class="btn btn-success btn-sm" href="?a=responder-mensagem-de-usuario&user_id=<?= $message["user_id"] ?>&product-id=<?= $message['product_id'] ?>">Responder</a>

                            <?php endif ?>

                            <?php if ($message['chat_deleted'] === NULL) : ?>


                                <a href="?a=delete-user-message/<?= $message['chat_message_id']; ?> " class="btn-delete-product btn btn-danger btn-sm">Excluir</a>

                            <?php endif ?>



                        </div>

                    </div>

                    <!-- Answer -->
                    <?php if (isset($message['answer'])) : ?>

                        <?php if ($message['answer'] != '') : ?>

                            <div style="width:fit-content" class=" d-flex gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#909090" class="bi bi-arrow-return-right mt-1" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5" />
                                </svg>

                                <div class="border rounded shadow-sm p-2">

                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <p class="m-0 me-3"><?= APP_NAME ?></p>
                                        <p style="font-size:13px" class="m-0"><?= date('d/m/Y', strtotime($message['answer_created_at'])) . ' às ' . date('H:i', strtotime($message['answer_created_at'])) . 'h' ?></p>
                                    </div>

                                    <p class="m-0 "><?= $message['answer']; ?></p>

                                </div>

                            </div>

                        <?php endif ?>

                    <?php endif ?>

                <?php endif ?>

            <?php endforeach ?>

        <?php else : ?>

            <p>Ainda não há mensagens de usuários</p>

        <?php endif ?>
    </div>

</div>