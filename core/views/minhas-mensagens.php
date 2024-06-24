<div style="min-height:100vh" class="container mx-auto row py-5 ">


    <div class="col-md-6 col-sm-12 mx-auto">
        <h5>Minhas mensagens</h5>

        <?php if (isset($data) && $data != null) : ?>


            <?php foreach ($data as $data) : ?>

                <!-- Question -->
                <?php if ($data['user_id'] != 1) : ?>

                    <div class="mt-3 mb-1 shadow-sm  rounded-1 border row">

                        <div class="p-2 col-10">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <img style="width:25px; height:25px" src="assets/images/user.png" alt="">
                                    <p class="ms-2"><?= $data['user_name']; ?></p>
                                </div>
                                <p style="font-size:13px" class="m-0">
                                    <?= date('d/m/Y', strtotime($data['chat_created_at'])) . ' às ' . date('H:i', strtotime($data['chat_created_at'])) . 'h' ?>
                                </p>
                            </div>

                            <p class="m-0 ps-2"><?= $data['message']; ?></p>
                        </div>

                        <div class="border-start p-2  col-auto">

                            <img style="max-height:70px" class="w-100 img-fluid" src="<?= $data['product_img_src']; ?>" alt="">

                            <p class="m-0"><?= $data['product_name']; ?></p>

                            <p class="m-0"><?= $data['product_price']; ?></p>

                        </div>

                    </div>

                    <!-- Answer -->
                    <?php if (isset($data['answer'])) : ?>

                        <?php if (($data['answer']) != '') : ?>

                            <!-- Answer -->
                            <div style="width:fit-content" class="d-flex gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#909090" class="bi bi-arrow-return-right mt-1" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5" />
                                </svg>

                                <div class="border rounded shadow-sm p-2">

                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <p class="m-0 me-3"><?= APP_NAME ?></p>
                                        <p style="font-size:13px" class="m-0"><?= date('d/m/Y', strtotime($data['answer_created_at'])) . ' às ' . date('H:i', strtotime($data['answer_created_at'])) . 'h' ?></p>
                                    </div>

                                    <p class="m-0 "><?= $data['answer']; ?></p>
                                </div>

                            </div>
                        <?php endif ?>

                    <?php endif ?>


                <?php else : ?>


                    <!--     HIDDEN -->
                    <div style="width:fit-content" class="d-none gap-2">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#909090" class="bi bi-arrow-return-right mt-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5" />
                        </svg>

                        <div class="border rounded shadow-sm p-2">

                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <p class="m-0 me-3"><?= APP_NAME ?></p>
                                <p style="font-size:13px" class="m-0"><?= date('d/m/Y', strtotime($data['chat_created_at'])) . ' às ' . date('H:i', strtotime($data['chat_created_at'])) . 'h' ?></p>
                            </div>

                            <p class="m-0 "><?= $data['message']; ?></p>
                        </div>

                    </div>




                <?php endif ?>

            <?php endforeach; ?>



        <?php else : ?>

            <p>Não há perguntas ainda</p>

        <?php endif; ?>

    </div>

</div>











