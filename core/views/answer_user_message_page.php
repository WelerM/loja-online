<div style="min-height:100vh" class="container py-5 row mx-auto   p-0">

    <div class="col-md-6 col-sm-12 mx-auto">


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


        <h5>Responder mensagem do usuário</h5>

        
        <!-- Currently HIDDEN -->
        <?php foreach ($data as $message): ?>

            <div style="height:fit-content" class="d-none row border m-0 p-0 rounded my-3">


                <div style="height:fit-content" class="col-8 p-2 border-0 border-end">

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
                    <div class=" border rounded">

                        <p><?= $message['user_message'] ?></p>

                    </div>

                </div>

                <!-- Product preview -->
                <div style="height:fit-content" class="col-auto">

                    <p class=" m-0">Produto</p>

                    <img src="<?= $message['product_img_src'] ?>" class="img-fluid m-0"
                        style="max-width: 60px; height: 60px" alt="">

                    <h5 class="m-0"><?= $message['product_name']; ?> </h5>

                    <p class="m-0"><?= 'R$ ' . $message['product_price']; ?> </p>

                </div>


            </div>

        <?php endforeach ?>

        <!-- In testes -->
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

        <form action="?a=answer_user_message/<?= $message['chat_message_id'] ?>" method="POST">

            <div class="form-floating mb-3">
                <textarea class="form-control bg-body-tertiary" name="answer" placeholder="Leave a comment here"
                    id="floatingTextarea2" style="height: 100px"></textarea>
                <label class="" for="floatingTextarea2">Resposta</label>
            </div>

            <!-- HIdden message id -->
            <input class="d-none" type="text" name="chat-message-id" value="<?= $message['chat_message_id'] ?>">

            <!-- HIdden product id-->
            <input class="d-none" type="text" name="product-id" value="<?= $message['product_id'] ?>">

            <!-- HIdden user id-->
            <input class="d-none" type="text" name="user-id" value="<?= $message['user_id'] ?>">

            <button class="btn btn-success btn-sm">Responder</button>

        </form>


    </div>

</div>