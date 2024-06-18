<div style="min-height: 100vh;" class="container  py-5">



    <?php if (isset($_SESSION['error'])) : ?>

        <div class="alert alert-danger d-flex gap-3 align-items-center justify-content-center  mx-auto" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
            </svg>
            <div>
                <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        </div>

    <?php endif; ?>

    <?php if (isset($_SESSION['success'])) : ?>

        <div class="alert alert-success d-flex gap-3 align-items-center justify-content-center mx-auto" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
            <div>
                <?= $_SESSION['success'] ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        </div>

    <?php endif; ?>


    <div class="pt-5 px-1 row">

        <div style="height:fit-content;" class="col-md-12 col-sm-12 mb-5 d-flex gap-2 px-0 ">


            <img class="img-fluid  w-50  " style=" max-height:400px" src="<?= $data['product_details']['img_src']; ?>" alt="...">

            <div class="w-50  d-flex flex-column p-3  ">
                <h1 class=""><?= $data['product_details']['name']; ?> </h1>
                <p class="fs-4"><?= $data['product_details']['price']; ?> </p>
                <p class=""> <?= $data['product_details']['description']; ?></p>
                <a href="#" class=""><?= $data['product_details']['link']; ?></a>

                <a href="?a=contact_store_page/<?= $data['product_details']['id']; ?>" style="width: fit-content" class="btn btn-success mt-4 btn-sm">Entrar em contato</a>


            </div>

        </div>

        <!-- Product questions -->
        <div class="col-md-6 col-sm-12 p-0">

            <?php if (isset($_SESSION['user_id'])) : ?><!-- User allowed to make question on product -->
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
                <a href="?a=login_page" class="my-5 ">

                    Crie uma conta para fazer perguntas

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