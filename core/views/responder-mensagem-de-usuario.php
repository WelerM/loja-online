<div style="min-height:100vh" class="container py-5 row mx-auto   p-0">

    <div class="col-md-6 col-sm-12 mx-auto">


        <?php include('components/alert.php');?>

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