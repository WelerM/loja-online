document.querySelectorAll('.btn-ver-chat').forEach((btn) => {

    btn.addEventListener('click', (e) => {

        let product_message_id = e.target.name

        axios.defaults.withCredentials = true;
        axios.get('?a=show_product_question_details&product_message_id=' + product_message_id)
            .then(function (response) {

                let data = response.data


                let questions_header_display = document.querySelector('.questions-header-display')
                let img = document.querySelector('.user-img-icon')
                img.setAttribute('src', 'assets/images/user.png')

                let client_name = document.querySelector('.user-name')
                client_name.textContent = data[0].user_name

                let ul = document.querySelector('.ul-questions')
                ul.innerHTML = ''

                data.map(item => {


                    let li = document.createElement('li')

                    if (item.question_active === 1) {
                        li.classList.add('p-2', 'border', 'rounded-1', 'm-1', 'd-flex', 'justify-content-between', 'bg-warning')
                    } else {

                        li.classList.add('p-2', 'border', 'rounded-1', 'm-1', 'd-flex', 'justify-content-between')
                    }

                    let client_text = document.createElement('span')
                    client_text.textContent = item.user_question

                    let client_text_time = document.createElement('span')
                    client_text_time.setAttribute('style', 'font-size:12px')

                    let [datePart, timePart] = item.question_created_at.split(' ');
                    let [year, month, day] = datePart.split('-');
                    let [hours, minutes] = timePart.split(':');
                    let formatted_date = `${day}/${month}/${year} às ${hours}:${minutes}h`;


                    client_text_time.textContent = formatted_date

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

// Input mask for product price

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





//Input treatment for views "register", "login", "edit product"


if (document.querySelector('form')) {
    
    const inputName = document.querySelector('.input-name');
    const inputEmail = document.querySelector('.input-email');
    const inputPassword = document.querySelector('.input-password');
    const inputRepeatPassword = document.querySelector('.input-repeat-password');
    const alertError = document.querySelector('.js-alert-error');

    document.querySelector('form').addEventListener('submit', (event) => {
        let hasError = false;
        alertError.classList.add('d-none');
        alertError.innerHTML = '';

        // Validação do Nome
        if (inputName.value.trim() === '') {
            hasError = true;
            showError(inputName, 'Por favor, insira seu nome completo.');
        } else {
            removeError(inputName);
        }

        // Validação do Email
        if (inputEmail.value.trim() === '') {
            hasError = true;
            showError(inputEmail, 'Por favor, insira seu email.');
        } else if (!validateEmail(inputEmail.value)) {
            hasError = true;
            showError(inputEmail, 'Por favor, insira um email válido.');
        } else {
            removeError(inputEmail);
        }

        // Validação da Senha
        if (inputPassword.value.trim() === '') {
            hasError = true;
            showError(inputPassword, 'Por favor, insira sua senha.');
        } else if (inputPassword.value.length < 6) {
            hasError = true;
            showError(inputPassword, 'A senha deve ter pelo menos 6 caracteres.');
        } else {
            removeError(inputPassword);
        }

        // Validação da Repetição de Senha
        if (inputRepeatPassword.value.trim() === '') {
            hasError = true;
            showError(inputRepeatPassword, 'Por favor, repita sua senha.');
        } else if (inputRepeatPassword.value !== inputPassword.value) {
            hasError = true;
            showError(inputRepeatPassword, 'As senhas não coincidem.');
        } else {
            removeError(inputRepeatPassword);
        }

        if (hasError) {
            event.preventDefault();
            alertError.classList.remove('d-none');
            alertError.innerHTML = 'Por favor, corrija os erros antes de continuar.';
        }
    });

    function showError(input, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.innerHTML = message;
        input.classList.add('is-invalid');
        if (input.nextElementSibling) {
            input.nextElementSibling.remove();
        }
        input.insertAdjacentElement('afterend', errorDiv);
    }

    function removeError(input) {
        input.classList.remove('is-invalid');
        if (input.nextElementSibling) {
            input.nextElementSibling.remove();
        }
    }

    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()\[\]\\.,;:\s@"]+\.)+[^<>()\[\]\\.,;:\s@"]{2,})$/i;
        return re.test(String(email).toLowerCase());
    }
}