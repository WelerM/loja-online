<div style="min-height: 100vh;" class="mx-auto container p-0 row ">

    <div class="mx-auto px-2 py-5 col-md-6 col-sm-12">


        <?php include('components/alert.php'); ?>


        <h5 class="mb-4">Entre em contato conosco</h5>

        <p class="">Produto selecionado:</p>

        <!-- Product preview -->
        <div style="height:fit-content;" class="border d-flex gap-2 p-2 rounded mb-4">

            <img class="img-fluid " style="height:90px" src="<?= $data['product_details']['img_src']; ?>" alt="...">

            <div class="d-flex flex-column ">
                <p class="m-0"><?= $data['product_details']['name']; ?> </p>
                <p class="m-0"><?= $data['product_details']['price']; ?> </p>
                <p class="m-0"> <?= $data['product_details']['description']; ?></p>
                <p class="m-0"><?= $data['product_details']['link']; ?></p>
            </div>

        </div>



        <?php if (empty($data['user_chat_messages'])) : ?>

            <p class="">Ainda não há mensagem</p>

        <?php else : ?>

            <p>Suas mensagem:</p>

            <div class="chat-container" style="max-height:500px; overflow-y:scroll;">

                <?php foreach ($data['user_chat_messages'] as $message) : ?>

                    <!-- Question -->
                    <div class="">
                        <!-- Question -->
                        <div class="mt-3 mb-1 shadow-sm p-2 rounded-1 border">

                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <img style="width:25px; height:25px" src="assets/images/user.png" alt="">
                                    <p class="ms-2"><?= ($message['user_id'] === 1) ? 'Loja Online' : $message['user_name']; ?>
                                    </p>
                                </div>
                                <p style="font-size:13px" class="m-0">
                                    <?= date('d/m/Y', strtotime($message['message_created_at'])) . ' às ' . date('H:i', strtotime($message['message_created_at'])) . 'h' ?>
                                </p>
                            </div>

                            <p class="m-0 ps-2"><?= $message['message']; ?></p>

                        </div>

                    </div>

                    <!-- Answer -->
                    <?php if ($message['admin_answer'] != '') : ?>
                        <!-- Answer -->

                        <div style="width:fit-content" class="d-flex gap-2">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#909090" class="bi bi-arrow-return-right mt-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5" />
                            </svg>

                            <div class="border rounded shadow-sm p-2">

                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <p class="m-0 me-3"><?= APP_NAME ?></p>
                                    <p style="font-size:13px" class="m-0"><?= date('d/m/Y', strtotime($message['answer_created_at'])) . ' às ' . date('H:i', strtotime($message['answer_created_at'])) . 'h' ?></p>
                                </div>

                                <p class="m-0 "><?= $message['admin_answer']; ?></p>
                            </div>

                        </div>
                    <?php endif ?>


                <?php endforeach ?>

            </div>

        <?php endif ?>


        <?php if (!$data['send_new_message']) : ?>

            <div class="alert alert-success">
                Por favor, aguarde ser respondido para enviar novas mensagens.
            </div>

        <?php else : ?>

            <div class="mt-4">
                <p>Escreva sua mensagem</p>

                <!-- Form only shows if the user question for this product is set to is_responded = 1 -->
                <form action="?a=contact_store" method="POST">

                    <div class="form-floating">
                        <textarea name="user-message" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Mensagem</label>
                    </div>

                    <!-- Hidden ( product id ) -->
                    <input class="d-none" name="product-id" value="<?= $data['product_details']['id']; ?>" type="text">

                    <!-- Hidden ( user id ) -->
                    <input class="d-none" name="user-id" value="<?= $_SESSION['user_id']; ?>" type="text">

                    <button class="btn btn-success btn-sm my-2" type="submit">Enviar </button>

                </form>
            </div>
        <?php endif ?>


    </div>

</div>