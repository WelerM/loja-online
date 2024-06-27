<div style="min-height: 100vh;" class="container mx-auto pb-3">

    <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>


    <div class="pt-5 px-1  mx-auto">

        <div style="height:fit-content;" class="row px-0">

            <!-- Product image -->
            <img class="col-md-7 col-sm-12 img-fluid mx-auto" style=" max-height:400px" src="<?= $data['product_details']['img_src']; ?>" alt="...">

            <!-- Product info -->
            <div class=" col-md-5 col-sm-12 d-flex flex-column p-3 mx-auto   ">
                <h1 class=""><?= $data['product_details']['name']; ?> </h1>
                <p class="fs-4"><?= 'R$ ' . number_format($data['product_details']['price'], 2, ',', '.'); ?> </p>
                <p class=""> <?= $data['product_details']['description']; ?></p>
                <a href="#" class=""><?= $data['product_details']['link']; ?></a>

                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '1') : ?>
                    <a href="?a=contatar-loja/<?= $data['product_details']['id']; ?>" style="width: fit-content" class="btn btn-success mt-4 btn-sm">Entrar em contato</a>
                <?php endif; ?>
                
            </div>

        </div>

        <!-- Product questions -->
        <div class="row">

            <div class="col-md-6 col-sm-12 ">

                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === '1') : ?><!-- User allowed to make question on product -->

                    <div class="alert alert-danger text-center">

                        Você não pode fazer perguntas pois é o administrador
                    </div>

                <?php elseif (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '1') : ?>

                    <div class="mt-3 ">

                        <form class="flex-column px-0 mb-5 py-1  " action="?a=make_question&product_id=<?= $data['product_details']['id']; ?>" method="POST">

                            <!-- Product description-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="question-text" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Fazer pergunta (clinet view)</label>
                            </div>


                            <button id="btn-form-submit" type="submit" name="submit" class="btn btn-success mx-0 d-flex align-items-center justify-content-center" style="width: fit-content;">Enviar</button>

                        </form>

                    </div>
                <?php else : ?>
                    <!-- Create account to make a question -->
                    <a href="?a=entrar" class="my-5 ">

                        Esteja logado para fazer perguntas

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5" />
                            <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z" />
                        </svg>
                    </a>


                <?php endif; ?>


                <!--Loop through product questions -->
                <?php if (isset($data) && $data != null) : ?>

                    <?php if (isset($data['product_messages']) && !empty($data['product_messages'])) : ?>

                        <?php foreach ($data['product_messages'] as $message) : ?>

                            <!-- Question -->
                            <div class="">
                                <!-- Question -->
                                <div class="mt-3 mb-1 shadow-sm p-2 rounded-1 border">

                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex">
                                            <img style="width:25px; height:25px" src="assets/images/user.png" alt="">
                                            <p class="ms-2"><?= $message['user_name']; ?></p>
                                        </div>
                                        <p style="font-size:13px" class="m-0"><?= date('d/m/Y', strtotime($message['message_created_at'])) . ' às ' . date('H:i', strtotime($message['message_created_at'])) . 'h' ?></p>
                                    </div>

                                    <p class="m-0 ps-2"><?= $message['user_message']; ?></p>

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
                            </div>

                        <?php endforeach; ?>

                    <?php else : ?>
                        <p>Não há perguntas ainda</p>
                    <?php endif; ?>


                <?php endif; ?>
            </div>

        </div>

    </div>

</div>