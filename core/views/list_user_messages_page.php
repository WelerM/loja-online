<div style="min-height:100vh" class="container row  mx-auto py-5">

    <div class="col-md-6 col-sm-12 mx-auto">
        <h5>Mensagens de usuários</h5>


        <?php if (!empty($data)) : ?>

            <?php foreach ($data as $message) : ?>

                <div style="width: w-100;" class="row border p-0 my-3 rounded shadow-sm ">

                    <div class="col-8 border-0 border-end p-3">

                        <div class="d-flex justify-content-between">

                            <div class="d-flex gap-3">
                                <img style="width:30px; height:30px" src="assets/images/user.png" alt="">
                                <p><?= $message['user_name'] ?> </p>
                            </div>


                            <p style="font-size:13px">
                                <?= date('d/m/Y', strtotime($message['chat_created_at'])) . ' às ' . date('H:i', strtotime($message['chat_created_at'])) . 'h' ?>
                            </p>

                        </div>

                        <!-- User question text -->
                        <div class="bg-white p-2 border rounded">

                            <p><?= $message['user_message'] ?></p>
                        </div>


                        <div style="height: fit-content;" class="d-flex gap-1 mt-2  ">

                            <a class="btn btn-success btn-sm" href="?a=answer_user_message_page/user_id=<?= $message["user_id"] ?>&product-id=<?= $message['product_id'] ?>">Responder</a>

                            <button class="btn btn-danger btn-sm">Exclur</button>


                        </div>

                    </div>

                    <div class="col-auto p-3">

                        <p>Produto</p>

                        <img src="<?= $message['product_img_src'] ?>" class="img-fluid" style="max-width: 60px; height: 60px" alt="">

                        <h5 class="card-title"><?= $message['product_name']; ?> </h5>

                        <p class="card-title"><?= 'R$ ' . $message['product_price']; ?> </p>
                    </div>

                </div>


            <?php endforeach ?>


        <?php else : ?>

            <p>Ainda não há mensagens de usuários</p>

        <?php endif ?>
    </div>

</div>