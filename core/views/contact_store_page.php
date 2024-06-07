<div style="min-height: 100vh;" class="mx-auto container p-0 row ">

    <div class="mx-auto px-2 py-5 col-md-6 col-sm-12">


        <?php if (isset($_SESSION['error'])): ?>

            <div class="alert alert-danger d-flex gap-3 align-items-center justify-content-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                <div>
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            </div>

        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>

            <div class="alert alert-success d-flex gap-3 align-items-center justify-content-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>

                <div>
                    <?= $_SESSION['success'] ?>
                    <?php unset($_SESSION['success']); ?>
                </div>

            </div>

        <?php endif; ?>


        <h1 class="mb-4">Entre em contato conosco</h1>

        <h5>Produto selecionado:</h5>

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



        <?php if (empty($data['user_chat_messages'])): ?>

            <h5>Ainda não há mensagem</h5>

        <?php else: ?>

            <h5>Suas mensagem:</h5>

            <div class="chat-container" style="max-height:500px; overflow-y:scroll;">

                <?php foreach ($data['user_chat_messages'] as $message): ?>

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
                <?php endforeach ?>

            </div>

        <?php endif ?>


        <?php if (!$data['send_new_message']): ?>

            <div class="alert alert-success">
                Por favor, aguarde ser respondido para enviar novas mensagens.
            </div>

        <?php else: ?>

            <div class="mt-4">
                <h5>Escreva sua mensagem</h5>

                <!-- Form only shows if the user question for this product is set to is_responded = 1 -->
                <form action="?a=contact_store" method="POST">

                    <div class="form-floating">
                        <textarea name="user-message" class="form-control" placeholder="Leave a comment here"
                            id="floatingTextarea2" style="height: 100px"></textarea>
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