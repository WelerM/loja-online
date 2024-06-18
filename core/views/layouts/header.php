<?php

use core\classes\Functions;

?>

<nav class="navbar navbar-expand-lg  bg-body-tertiary border-bottom">

    <div class="container-fluid ">

        <a class="navbar-brand text-success fw-bold" href="?a=home"><?= APP_NAME ?></a>



        <form class="d-flex " role="search">

            <input class="no-focus-border form-control rounded-0 rounded-start " type="search" placeholder="Pesquisar produtos" aria-label="Search">

            <button class="btn rounded-0 rounded-end px-3 py-0 bg-white border border-start-0 " type="submit">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>

            </button>

        </form>



        <button class="navbar-toggler  " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon  bg-light"></span>
        </button>



        <div class="collapse navbar-collapse " id="navbarSupportedContent" style="flex-grow: 0;">


            <ul class="navbar-nav  mb-2 mb-lg-0 border-0">

                <div class="d-flex gap-3 me-5">

                    <li class="nav-item text-center p-0  d-flex align-items-center ">
                        <a class="nav-link p-0" href="?a=home_page">
                            Home
                        </a>
                    </li>


                    <li class="nav-item text-center p-0  me-2  d-flex align-items-center">
                        <a class="nav-link p-0" href="?a=login_page">
                            Sobre nós
                        </a>
                    </li>

                </div>


                <?php if (!Functions::user_logged()) : ?>


                    <li class="nav-item text-center p-0  me-2">
                        <a class="nav-link p-0" href="?a=login_page">
                            <button class="btn btn-success border m-0">Entrar</button>
                        </a>
                    </li>

                    <li class="nav-item text-center p-0 ">
                        <a class="nav-link p-0" href="?a=register_page">
                            <button class="btn btn-success border m-0">Registrar</button>
                        </a>
                    </li>


                <?php else : ?>

                    <button class="btn d-flex gap-2 align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUser" aria-controls="offcanvasUser">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>

                        <?php if ($_SESSION['user_type'] === 'admin') : ?>
                            <span class="badge text-bg-danger"> <?= $_SESSION['user_type'] ?></span>
                        <?php else : ?>
                            <?= $_SESSION['user_name'] ?>
                        <?php endif; ?>

                    </button>

                <?php endif; ?>

            </ul>

        </div>

    </div>
</nav>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUser" aria-labelledby="offcanvasExampleLabel">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">


        <ul class="d-flex flex-column align-items-start p-0 w-100">

            <?php if (Functions::user_logged()) : ?>


                <?php if ($_SESSION['user_type'] === 'admin') : ?>

                    <!-- Create product -->
                    <li class="nav-item bg-danger-subtle py-2 px-2 w-100">

                        <a class="nav-link d-flex justify-content-between " href="?a=create_product_page">

                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                                Criar produto
                            </div>

                            <span class="badge text-bg-danger mb-1">Admin</span>

                        </a>


                    </li>

                    <!-- My products -->
                    <li class="nav-item bg-danger-subtle py-2 px-2 w-100">
                        <a class="nav-link d-flex justify-content-between " href="?a=my_products_page">
                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
                                </svg>

                                Meus produtos

                                <?php if ($header_data['products_count'] != 0) : ?>
                                    <span style="font-size: 10px; height:fit-content;" class="badge text-bg-danger lh-base py-1 "> <?= $header_data['products_count'] ?></span>
                                <?php endif ?>

                            </div>

                            <span class="badge text-bg-danger mb-1">Admin</span>

                        </a>
                    </li>

                    <!-- Products questions -->
                    <li class="nav-item bg-danger-subtle py-2 px-2 w-100">

                        <a class="nav-link d-flex justify-content-between " href="?a=answer_questions_page">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
                                </svg>

                                Perguntas em produtos

                                <?php if ($header_data['products_questions_count'] != 0) : ?>
                                    <span style="font-size: 10px; height:fit-content;" class="badge text-bg-danger lh-base py-1 "> <?= $header_data['products_questions_count'] ?></span>
                                <?php endif ?>

                            </div>
                            <span class="badge text-bg-danger">Admin</span>
                        </a>
                    </li>

                    <!-- User messages -->
                    <li class="nav-item bg-danger-subtle py-2 px-2 w-100">

                        <a class="nav-link d-flex justify-content-between " href="?a=list_user_messages_page">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                                </svg>
                                Mensagens de usuários


                                <?php if ($header_data['user_messages_count'] != 0) : ?>
                                    <span style="font-size: 10px; height:fit-content;" class="badge text-bg-danger lh-base py-1 "> <?= $header_data['user_messages_count'] ?></span>
                                <?php endif ?>

                            </div>
                            <span class="badge text-bg-danger">Admin</span>

                        </a>
                    </li>

                <?php else : ?>
                    <!-- Colocar "mensagens" LI aqui -->
                <?php endif; ?>

                <!-- Messages (client view) -->
                <li class="nav-item  py-2 px-2 w-100">


                    <a class="nav-link  d-flex gap-2 align-items-center" href="?a=my_messages_page">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                        </svg>

                        Mensagens

                    </a>

                </li>

                <!-- My account -->
                <li class="nav-item  py-2 px-2 w-100">

                    <a class="nav-link  d-flex gap-2 align-items-center " href="?a=account_page">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>

                        Minha conta
                    </a>

                </li>

                <!-- Logout -->
                <li class="nav-item  py-2 px-2 w-100">
                    <a class="nav-link d-flex gap-2 align-items-center " href="?a=signout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                        </svg>
                        Sair
                    </a>
                </li>

            <?php endif ?>

        </ul>

    </div>

</div>