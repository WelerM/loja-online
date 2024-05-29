document.querySelectorAll('.btn-ver-chat').forEach((btn) => {
   
    btn.addEventListener('click', (e) => {

        let product_id = e.target.name
        let user_id = document.querySelector('.client-id').value

        let input_product_id = document.querySelector('.product-id')
        input_product_id.setAttribute('value', product_id)

  
        axios.defaults.withCredentials = true;
        axios.get('?a=get_all_user_questions_by_product&product_id=' + product_id + '&user_id=' + user_id)
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
        // layout.btn_choose_img();
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



































// function test() {
//     axios.defaults.withCredentials = true;
//     axios.get('?a=get_all_user_questions_by_product&product_id=' + 4 + '&user_id=' + 8)
//         .then(function (response) {
//             console.log('ola');
//             let data = response.data

//             console.log(data);
//             let questions_header_display = document.querySelector('.questions-header-display')
//             let img = document.createElement('img')
//             img.setAttribute('src', 'assets/images/user.png')
//             img.style.width = '30px'

//             let client_name = document.createElement('span')
//             client_name.textContent = data[0].user_name
//             client_name.classList.add('fw-bold')

//             questions_header_display.appendChild(img)
//             questions_header_display.appendChild(client_name)


//             let ul = document.querySelector('.ul-questions')

//             data.map(item => {

//                 let li = document.createElement('li')
//                 li.classList.add('p-2', 'border', 'rounded-1', 'm-1', 'd-flex', 'gap-1')

//                 let client_text = document.createElement('span')
//                 client_text.textContent = item.user_question

//                 let client_text_time = document.createElement('span')

//                 li.appendChild(client_text)
//                 ul.appendChild(li)

//             })

//         }
//         )
// } 