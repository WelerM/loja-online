document.querySelectorAll('.btn-ver-chat').forEach((btn) => {

    btn.addEventListener('click', (e) => {


        let product_message_id = e.target.name

        // let product_id = document.querySelector('.product-id')
        // product_id = product_id.getAttribute('name')

        // let product_message_id = document.querySelector('.product-message-id')
        // product_message_id = product_message_id.getAttribute('name')

        console.log();

        axios.defaults.withCredentials = true;
        axios.get('?a=show_product_question_details&product_message_id=' + product_message_id)
            .then(function (response) {

                let data = response.data

                console.log(data);

                let questions_header_display = document.querySelector('.questions-header-display')
                let img = document.querySelector('.user-img-icon')
                img.setAttribute('src', 'assets/images/user.png')

                let client_name = document.querySelector('.user-name')
                client_name.textContent = data[0].user_name

                let ul = document.querySelector('.ul-questions')
                ul.innerHTML = ''

                data.map(item => {
                    console.log(item);

                    let li = document.createElement('li')

                    if (item.question_active === 1) {
                        li.classList.add('p-2', 'border', 'rounded-1', 'm-1', 'd-flex', 'justify-content-between', 'bg-warning')
                    } else {

                        li.classList.add('p-2', 'border', 'rounded-1', 'm-1', 'd-flex', 'justify-content-between')
                    }

                    let client_text = document.createElement('span')
                    client_text.textContent = item.user_question

                    let client_text_time = document.createElement('span')
                    client_text_time.style.fontSize = '12 px'
                    client_text_time.textContent = item.question_created_at

                    //Hidden
                    let input_product_message_id = document.querySelector('.product-message-id')
                    input_product_message_id.setAttribute('value', item.product_message_id)

                    //Hidden
                    let input_product_id = document.querySelector('.product-id')
                    input_product_id.setAttribute('value', item.product_id)

                    //Hidden
                    let product_user_id = document.querySelector('.product-user-id')
                    product_user_id.setAttribute('value', item.user_id)


                    li.appendChild(client_text)
                    li.appendChild(client_text_time)
                    ul.appendChild(li)

                })

            }
            )

    })
})


//Triigers input file in order to choose an image from the system
if (document.querySelector('.btn-add-img')) {
    document.querySelector('.btn-add-img').addEventListener('click', (e) => {
        e.preventDefault();

        document.querySelector('#form-input').click();

        if (document.querySelector("#form-input")) {

            document.querySelector("#form-input").addEventListener('change', () => {
                let img_file = document.querySelector('#form-input')

                if ((img_file.files) && (img_file.files[0])) {

                    var reader = new FileReader()

                    reader.onload = function (e) {

                        //Shows image
                        let img_preview_container = document.querySelector('#img-preview')
                        img_preview_container.classList.remove('d-none')
                        img_preview_container.classList.add('d-flex')
                        img_preview_container.setAttribute('src', e.target.result)


                    }
                    reader.readAsDataURL(img_file.files[0])
                }
            })
        }
    })

}



//Triigers input file in order to choose an image from the system
if (document.querySelector('.btn-edit-img')) {
    document.querySelector('.btn-edit-img').addEventListener('click', (e) => {
        e.preventDefault();

        document.querySelector('#form-input').click();

        if (document.querySelector("#form-input")) {

            document.querySelector("#form-input").addEventListener('change', () => {
                let img_file = document.querySelector('#form-input')

                if ((img_file.files) && (img_file.files[0])) {

                    var reader = new FileReader()

                    reader.onload = function (e) {

                        //Shows image
                        document.querySelector('.img-edit-preview').setAttribute('src', e.target.result)


                    }
                    reader.readAsDataURL(img_file.files[0])
                }
            })
        }
    })

}


if (document.querySelector('.btn-delete-product')) {

    document.querySelectorAll('.btn-delete-product').forEach((btn) => {


        btn.addEventListener('click', (e) => {
            e.preventDefault();

            Swal.fire({
                title: "Tem certeza que quer deletar o produto?",
                text: "Isso não pode ser revertido!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, quero deletar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Produto deletado!",
                        text: "O produto foi deletado com sucesso.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = btn.href;
                    })

                }
            });
        })
    })

}



// create_product_page view
if (document.querySelector('#btn-fake-add-img')) {
    document.querySelector('#btn-fake-add-img').addEventListener('click', () => {
        //let btn_real_add_img = 
        document.querySelector('.btn-add-img').click()
    })
}



if (document.querySelector('.chat-container')) {
    let chat_container = document.querySelector('.chat-container')
    chat_container.scrollTop = chat_container.scrollHeight;
}




//
if (document.querySelector('.btn-delete-product-question')) {

    document.querySelectorAll('.btn-delete-product-question').forEach((btn) => {



        btn.addEventListener('click', (e) => {

            e.preventDefault();


            Swal.fire({
                title: "Tem certeza que quer deletar esta mensagem?",
                text: "Isso não pode ser revertido!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, quero deletar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Mensagem deletada!",
                        text: "O produto foi deletado com sucesso.",
                        icon: "success"
                    }).then(() => {

                        window.location.href = btn.href;

                    })

                }
            });
        })
    })
}

// Input mask

if (document.querySelector('.input-price')) {
    document.querySelectorAll('.input-price').forEach((btn) => {

        btn.addEventListener('input', (e) => {
            //Removes non number characters
            let input_value = e.target.value.replace(/[^\d]/g, '');

            let formatted_input_value = (input_value.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + input_value.slice(-2);

            formatted_input_value = formatted_input_value.slice(0, -2) + ',' + formatted_input_value.slice(-2);

            e.target.value = formatted_input_value
        })
    })

}