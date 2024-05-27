document.querySelectorAll('.btn-ver-chat').forEach((btn) => {

    btn.addEventListener('click', (e) => {

        let product_id = e.target.name
        let client_id = document.querySelector('.client-id').value

        let input_product_id = document.querySelector('.product-id')
        input_product_id.setAttribute('value', product_id)


        axios.defaults.withCredentials = true;
        axios.get('?a=get_all_user_questions_by_product&product_id=' + product_id + '&user_id=' + client_id)
            .then(function (response) {

                let data = response.data

      
                let questions_header_display = document.querySelector('.questions-header-display')
                let img = document.createElement('img')
                img.setAttribute('src', 'assets/images/user.png')
                img.style.width = '30px'

                let client_name = document.createElement('span')
                client_name.textContent = data[0].user_name
                client_name.classList.add('fw-bold')

                questions_header_display.appendChild(img)
                questions_header_display.appendChild(client_name)


                let ul = document.querySelector('.ul-questions')

                data.map(item => {

                    let li = document.createElement('li')
                    li.classList.add('p-2', 'border', 'rounded-1', 'm-1', 'd-flex', 'gap-1')

                    let client_text = document.createElement('span')
                    client_text.textContent = item.user_question

                    let client_text_time = document.createElement('span')

                    li.appendChild(client_text)
                    ul.appendChild(li)

                })

            }
            )

    })
})


function test() {
    axios.defaults.withCredentials = true;
    axios.get('?a=get_all_user_questions_by_product&product_id=' + 4 + '&user_id=' + 8)
        .then(function (response) {
            console.log('ola');
            let data = response.data

            console.log(data);
            let questions_header_display = document.querySelector('.questions-header-display')
            let img = document.createElement('img')
            img.setAttribute('src', 'assets/images/user.png')
            img.style.width = '30px'

            let client_name = document.createElement('span')
            client_name.textContent = data[0].user_name
            client_name.classList.add('fw-bold')

            questions_header_display.appendChild(img)
            questions_header_display.appendChild(client_name)


            let ul = document.querySelector('.ul-questions')

            data.map(item => {

                let li = document.createElement('li')
                li.classList.add('p-2', 'border', 'rounded-1', 'm-1', 'd-flex', 'gap-1')

                let client_text = document.createElement('span')
                client_text.textContent = item.user_question

                let client_text_time = document.createElement('span')

                li.appendChild(client_text)
                ul.appendChild(li)

            })

        }
        )
} 