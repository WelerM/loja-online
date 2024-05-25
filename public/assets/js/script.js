document.querySelectorAll('.btn-ver-chat').forEach((btn) => {

    btn.addEventListener('click', (e) => {

        let product_id = e.target.name
        let client_id = document.querySelector('.client-id').value

        let input_product_id = document.querySelector('.product-id')
        input_product_id.setAttribute('value', product_id)

        console.log(product_id);

        axios.defaults.withCredentials = true;
        axios.get('?a=get_all_user_questions_by_product&product_id=' + product_id + '&client_id=' + client_id)
            .then(function (response) {


                console.log(response.data);

                let data = response.data

                let ul = document.querySelector('.ul-questions')

                data.map(item => {
                    let li = document.createElement('li')

                    let img = document.createElement('img')
                    img.setAttribute('src', 'assets/images/user.png')

                    let span = document.createElement('span')
                    span.textContent = item.question

                    li.appendChild(img)
                    li.appendChild(span)

                    li.classList.add('p-2', 'border', 'rounded-1', 'm-1', 'd-flex', 'gap-1')


                    ul.appendChild(li)

                })

            }
            )

    })
})


