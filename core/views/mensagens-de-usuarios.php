<div style="min-height:100vh" class="container row  mx-auto px-1 py-3">

    <div class="col-md-6 col-sm-12 mx-auto p-0">


    <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>




        <h5>Mensagens de usuários</h5>


        <?php if (!empty($data)) : ?>

            <?php foreach ($data as $message) : ?>

                <div class="border p-1 my-3 rounded shadow w-100">

                    <div class="p-0">

                        <!-- User icon, name and message timestamp -->
                        <div class="d-flex justify-content-between">

                            <div class="d-flex gap-3">
                                <img style="width:30px; height:30px" src="assets/images/user.png" alt="">
                                <p><?= $message['user_name'] ?> </p>
                            </div>


                            <p style="font-size:13px">
                                <?= date('d/m/Y', strtotime($message['chat_created_at'])) . ' às ' . date('H:i', strtotime($message['chat_created_at'])) . 'h' ?>
                            </p>

                        </div>

                        <!-- User message -->
                        <div class="bg-white py-2 bg-body-tertiary border px-1">
                            <p><?= $message['user_message'] ?></p>
                        </div>


                        <div class=" d-flex gap-2">

                            <p>Produto: </p>

                            <div>
                                <p class="fw-bold m-0"><?= $message['product_name'] ?> </p>
                                <p class="fw-bold m-0"><?= 'R$ ' . number_format($message['product_price'], 2, ',', '.'); ?></p>
                            </div>

                        </div>

                        <!-- Btns container text -->
                        <div style="height: fit-content;" class="d-flex gap-1 mt-2  ">

                            <a class="btn btn-success btn-sm" href="?a=responder-mensagem-de-usuario&user_id=<?= $message["user_id"] ?>&product-id=<?= $message['product_id'] ?>">Responder</a>

                            <a href="?a=delete-user-message/<?= $message['chat_message_id']; ?> " class="btn-delete-product btn btn-danger btn-sm">Excluir</a>
                            

                        </div>


                    </div>

                </div>


            <?php endforeach ?>


        <?php else : ?>

            <p>Ainda não há mensagens de usuários</p>

        <?php endif ?>
    </div>

</div>