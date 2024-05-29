<div style="min-height: 100vh;" class="">

    <div class="container py-5">

        <h2>Perguntas não respondidas</h2>

        <?php foreach ($data as $item): ?>

            <div style="width: fit-content;" class="border d-flex flex-column gap-3 p-0 my-3 rounded-1 shadow">

                <div class="d-flex ">

                    <div class="border-0 border-end p-3">
                        <div class="d-flex gap-1">
                            <img style="width:30px; height:30px" src="assets/images/user.png" alt="">

                            <div class="d-flex justify-content-between gap-5">
                                <p><?= $item['user_name'] ?> </p>
                                <p><?= $item['last_active_question_date'] ?></p>
                            </div>
                        </div>
                        <div class="bg-dark-subtle p-2">

                            <p><?= $item['last_active_question'] ?></p>
                        </div>


                        <div style="height: fit-content;" class="d-flex gap-1 mt-2">

                            <button name="<?= $item['user_id'] ?>" class="btn-ver-chat btn btn-success" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                                aria-controls="offcanvasExample">
                                Responder
                            </button>

                            <button class="btn btn-danger btn-sm">Exclur</button>


                        </div>

                    </div>

                    <div class="d-flex p-3">
                        <img src="<?= $item['img_src'] ?>" class="img-fluid" style="max-width: 60px; height: 60px" alt="">
                    </div>

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

                        <input class="product-id d-none" name="product_id" value="<?= $item['product_id'] ?>"
                            type="text">
                        <input class="client-id d-none" name="client_id" value="<?= $item['user_id'] ?>" type="text">
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>