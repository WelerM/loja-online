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


            <ul class="navbar-nav  mb-2 mb-lg-0 border-0    ">



                <?php if (Functions::user_logged()): ?>


                    <?php if ($_SESSION['user_type'] === 'admin'): ?>

                        <li class="nav-item">
                            <a class="nav-link text-center " href="?a=create_product_page">Criar produto</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-center " href="?a=answer_questions_page">Responder</a>
                        </li>

                    <?php endif; ?>


                    <li class="nav-item">
                        <a class="nav-link text-center mb-2 " href="?a=account_page">Minha conta</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link text-center " href="?a=signout">Sair</a>
                    </li>

                <?php else: ?>

                    <li class="nav-item text-center p-0 me-2">
                        <a class="nav-link p-0" href="?a=login_page">
                            <button class="btn btn-white border m-0">Entrar</button>
                        </a>
                    </li>

                    <li class="nav-item text-center p-">
                        <a class="nav-link p-0" href="?a=register_page">
                            <button class="btn btn-white border m-0">Registrar</button>
                        </a>
                    </li>

                <?php endif; ?>


            </ul>




        </div>

    </div>
</nav>