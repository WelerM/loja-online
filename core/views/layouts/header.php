<?php

use core\classes\Functions;

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">

    <div class="container-fluid  ">

        <a class="navbar-brand text-success fw-bold" href="?a=home"><?= APP_NAME ?></a>


        <button class="navbar-toggler  " type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon  bg-light"></span>
        </button>



        <form class="d-flex " role="search">

            <input class="no-focus-border form-control rounded-0 rounded-start " type="search"
                placeholder="Pesquisar produtos" aria-label="Search">

            <button class="btn rounded-0 rounded-end px-3 py-0 bg-white border border-start-0 " type="submit">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                    viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>

            </button>

        </form>

        <div class="collapse navbar-collapse " id="navbarSupportedContent" style="flex-grow: 0;">


            <ul class="navbar-nav  mb-2 mb-lg-0 border-0">

                <div class="d-flex gap-3 me-5">
                    <li class="nav-item text-center p-0   d-flex align-items-center">
                        <a class="nav-link p-0" href="?a=login_page">
                            Fale com a gente
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green"
                                class="bi bi-envelope-fill ms-1" viewBox="0 0 16 16">
                                <path
                                    d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item text-center p-0  me-2  d-flex align-items-center">
                        <a class="nav-link p-0" href="?a=login_page">
                            Sobre nós
                        </a>
                    </li>
                </div>


                <?php if (!Functions::user_logged()): ?>


                    <li class="nav-item text-center p-0  me-2">
                        <a class="nav-link p-0" href="?a=login_page">
                            <button class="btn btn-white border m-0">Entrar</button>
                        </a>
                    </li>

                    <li class="nav-item text-center p-0 ">
                        <a class="nav-link p-0" href="?a=register_page">
                            <button class="btn btn-white border m-0">Registrar</button>
                        </a>
                    </li>


                <?php else: ?>

                    <button class="btn d-flex gap-2 align-items-center" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasUser" aria-controls="offcanvasUser">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>

                        <?php if ($_SESSION['user_type'] === 'admin'): ?>
                            <span class="badge text-bg-danger"> <?= $_SESSION['user_type'] ?></span>
                        <?php else: ?>
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

    <div class="offcanvas-body">

        <ul class="d-flex flex-column gap-3 align-items-start p-0">

            <?php if (Functions::user_logged()): ?>


                <?php if ($_SESSION['user_type'] === 'admin'): ?>

                    <li class="nav-item">
                        <a class="nav-link text-center " href="?a=create_product_page">
                            Criar produto
                            <span class="badge text-bg-danger mb-1">Admin</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-center " href="?a=answer_questions_page">
                            Responder
                            <span class="badge text-bg-danger">Admin</span>
                        </a>
                    </li>

                <?php else: ?>
                    <!-- Colocar "mensagens" LI aqui -->
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link text-center mb-2 " href="?a=account_page">Mensagens (client)</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-center mb-2 " href="?a=account_page">Minha conta</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-center " href="?a=signout">Sair</a>
                </li>

            <?php endif ?>

        </ul>

    </div>

</div>