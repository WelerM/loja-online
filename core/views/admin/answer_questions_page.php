<div style="min-height: 100vh;" class="">

    <div class="container py-5">


        <?php if (isset($_SESSION['error'])) : ?>

            <div class="alert alert-danger d-flex gap-3 align-items-center justify-content-center" role="alert">
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

            <div class="alert alert-success d-flex gap-3 align-items-center justify-content-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
                <div>
                    <?= $_SESSION['success'] ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            </div>

        <?php endif; ?>


        <h2>Perguntas não respondidas</h2>

        <?php foreach ($data as $item) : ?>

            <div style="width: w-100;" class="row border p-0 my-3 rounded shadow bg-body-tertiary">

                <div class="col-8 border-0 border-end p-3">

                    <div class="d-flex justify-content-between">

                        <div class="d-flex gap-3">
                            <img style="width:30px; height:30px" src="assets/images/user.png" alt="">
                            <p><?= $item['user_name'] ?> </p>
                        </div>


                        <p style="font-size:13px">
                            <?= date('d/m/Y', strtotime($item['message_created_at'])) . ' às ' . date('H:i', strtotime($item['message_created_at'])) . 'h' ?>
                        </p>

                    </div>

                    <!-- User question text -->
                    <div class="bg-white p-2 border rounded">

                        <p><?= $item['product_message'] ?></p>
                    </div>


                    <div style="height: fit-content;" class="d-flex gap-1 mt-2  ">

                        <button name="<?= $item['product_message_id'] ?>" class="btn-ver-chat btn btn-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
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
                <img style="" class="user-img-icon" src="" alt="">
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

                        <input class="product-id d-none" name="product_message_id" type="text">
                        <input class="client-id d-none" name="client_id" value="" type="text">
                    </form>

                </div>

            </div>

        </div>
    </div>

</div>