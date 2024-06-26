<div style="min-height: 100vh" class=" container  mx-auto py-3">


    <h5 class="">Adicionar produto</h5>

    <div class="row  ">
        <!-- img add container -->
        <div style="height:fit-content;" class="col-md-6 col-sm-12">

            <p  class="mb-2" style="font-size:1rem; font-weight:700">Imagem do produto</p>

            <div style="height:300px" class="border rounded">

                <p class="d-none  text-center fw-bold "></p>

                <!-- Img preview container -->
                <img style="max-height:250px"  id="img-preview" class=" mb-2 mx-auto img-fluid d-none" src="" alt="">

            </div>

            <button id="btn-fake-add-img" class='btn btn-success btn-sm '>Escolher imagem</button>

        </div>

        <form id="img-form" class="col-md-6 col-sm-12 flex-column    py-1 " action="?a=create_product" enctype="multipart/form-data" method="POST">
    
    
            <!-- Img input file HIDDEN-->
            <div id="container-input-file" class=" d-none mb-4">
    
    
                <label for="form-input" class="input-group-text d-flex align-items-center bg-transparent rounded-end-0 ">
    
                    Choose new image
    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right ms-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                    </svg>
    
                </label>
    
                <input id="form-input" type="file" class=" custom-file-button form-control rounded-0 rounded-end-1 " name="file">
    
    
            </div>
    
            <!-- Img name input trigger HIDE-->
            <button class="btn btn-add-img d-none align-items-center border mb-3">
    
                Choose an image
    
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image ms-2" viewBox="0 0 16 16">
                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                </svg>
    
            </button>
    
    
            <!-- Product name-->
            <div class="mb-3">
    
                <label for="input-img-name" class="form-label fw-bold ">Informações do produto</label>
    
                <input id="input-img-name" type="text" class="form-control bg-body-tertiary" name="product-name" placeholder="Nome do produto">
    
            </div>
    
            <!-- Product price-->
            <div class="mb-3">
    
                <label for="input-price" class="d-none form-label fw-bold ">Preço do produto</label>
    
                <input type="text" class="input-price form-control bg-body-tertiary" name="product-price" placeholder="Preço do produto">
    
            </div>
    
            <!-- Product description-->
            <div class="form-floating mb-3">
                <textarea class="form-control bg-body-tertiary" name="product-description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                <label class="" for="floatingTextarea2">Descrição do produto</label>
            </div>
    
            <!-- Product link-->
            <div class="mb-3">
    
                <label for="product-link" class="form-label fw-bold d-none">Link do produto</label>
    
                <input id="product-link" type="text" class="form-control bg-body-tertiary" name="product-link" placeholder="Link do produto">
    
            </div>
    
    
    
    
            <!-- Hidden input img id for UPDATES -->
            <div class="d-none">
                <label for="input-img-id" class="form-label d-none"></label>
                <input id="input-img-id" class="form-control d-none" name="input-img-id" type="text">
            </div>
    
    
    
    
            <button id="btn-form-submit" type="submit" name="submit" class="btn btn-success mx-0 d-flex align-items-center justify-content-center" style="width: fit-content;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download me-1" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                </svg>
                Save</button>
    
    
        </form>

    </div>





</div>