<div style="min-height: 100vh;" class="">

    <div class="container py-5">

        <h2>Perguntas não respondidas</h2>

        <?php foreach ($data as $item): ?>

            <div style="width: w-100;" class="row border p-0 my-3 rounded shadow bg-body-tertiary">

                <div class="col-8 border-0 border-end p-3">

                    <div class="d-flex justify-content-between">

                        <div class="d-flex gap-3">
                            <img style="width:30px; height:30px" src="assets/images/user.png" alt="">
                            <p><?= $item['user_name'] ?> </p>
                        </div>


                        <p style="font-size:13px">
                            <?= date('d/m/Y', strtotime($item['question_created_at'])) . ' às ' . date('H:i', strtotime($item['question_created_at'])) . 'h' ?>
                        </p>

                    </div>

                    <!-- User question text -->
                    <div class="bg-white p-2 border rounded">

                        <p><?= $item['product_question'] ?></p>
                    </div>


                    <div style="height: fit-content;" class="d-flex gap-1 mt-2  ">

                        <button name="<?= $item['product_message_id'] ?>" class="btn-ver-chat btn btn-success" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                            Responder
                        </button>

                        <button class="btn btn-danger btn-sm">Exclur</button>


                    </div>

                </div>

                <div class="col-auto p-3">
                    <p>Produto</p>
                    <img src="<?= $item['img_src'] ?>" class="img-fluid" style="max-width: 60px; height: 60px" alt="">
                    <h5 class="card-title"><?= $item['product_name']; ?> </h5>
                    <p class="card-title"><?= 'R$ ' . $item['product_price']; ?> </p>
                </div>

            </div>

        <?php endforeach; ?>
    </div>




    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">

            <div class="questions-header-display d-flex gap-1">
                <img style="30px" class="user-img-icon" src="" alt="">
                <span class="user-name fw-bold"></span>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">

            <div style="" class="d-flex flex-column gap-2">

                <ul class="ul-questions p-0">

                </ul>


                <div class="d-flex flex-column gap-1">

                    <form action="?a=answer_question" method="POST">
                        <textarea class="form-control" name="answer" id=""></textarea>
                        <button type="submit" class="btn btn-success btn-sm">Responder</button>

                        <input class="product-id d-none" name="product_id" value="" type="text">
                        <input class="client-id d-none" name="client_id" value="" type="text">
                    </form>

                </div>

            </div>

        </div>
    </div>

</div>