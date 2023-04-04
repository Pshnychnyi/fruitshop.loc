const fadeIn = (el, timeout, display) => {
    el.style.opacity = 0;
    el.style.display = display || 'block';
    el.style.transition = `opacity ${timeout}ms`;
    setTimeout(() => {
        el.style.opacity = 1;
    }, 10);
};

const fadeOut = (el, timeout) => {
    el.style.opacity = 1;
    el.style.transition = `opacity ${timeout}ms`;
    el.style.opacity = 0;

    setTimeout(() => {
        el.style.display = 'none';
    }, timeout);
};



const showMessage = (el) => {

    el.style.display = 'none'

    let flag = false

    if (!flag) {
        fadeIn(el, 500);
        flag = true;
    } else {
        fadeOut(el, 500);
        flag = false;
    }

    setTimeout(() => {
        fadeOut(el, 500)
    }, 3000)
}


const commentForm = document.getElementById('commentForm')
const form = document.querySelector('#respond')
const preloader = document.querySelector('.loader')
const alert = document.querySelector('#alert')
const cartRow = document.querySelector('#cart-row')
const count = document.querySelector('#count')


const addToCart = async (event) => {
    event.preventDefault()
    if (event.target.dataset.name === 'submit') {

        const formData = await new FormData(event.target.parentElement)
        const url = event.target.parentElement.action
        const data = {
            quantity: formData.get('quantity')
        }

        const response = await fetch(url, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: JSON.stringify(data)
        })

        const answer = await response.json()

        const id = +event.target.dataset.id
        count.textContent = answer.count
        if(answer.success && id) {
            document.querySelector(`#product-total-${id}`).innerHTML = `$${answer.total}`
        }


    }
}



const removeFromCart = async (event) => {
    event.preventDefault()

    const formData = await new FormData(event.target)
    const url = event.target.action

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': formData.get('_token')
        }
    })

    const answer = await response.json()

    if (answer.success && answer.product_id){
        Object.values(document.querySelectorAll('.table-body-row')).find((item) => {
            return item.dataset.id === answer.product_id
        }).innerHTML = ''

        count.textContent = answer.count
        if (answer.last === true) {
            cartRow.style.display = 'none'
            cartRow.parentElement.insertAdjacentHTML('beforeend','<h4 id="empty-cart-row">Корзина пуста</h4>')
        }
    }



}

const updateCart = async (event) => {
    event.preventDefault()
    if (event.target.dataset.name === 'submit') {
        const url = event.target.parentElement.action

        const response = await fetch(url)

        const answer = await response.json()

        if(answer.success && answer.finalPrice){

            const shipping = +document.querySelector('#shipping').textContent.substr(1)
            document.querySelector('#subtotal').innerHTML = `$${answer.finalPrice}`
            document.querySelector('#final-total').innerHTML = `$${answer.finalPrice + shipping}`
        }else {
            cartRow.style.display = 'none'
        }
    }
}

const sendComment = async (event) => {
    event.preventDefault()

    const formData = new FormData(commentForm)
    const uri = commentForm.action
    alert.innerHTML = ''
    const data = {
        _token: formData.get('_token'),
        name: formData.get('name'),
        email: formData.get('email'),
        content: formData.get('content'),
        comment_post_ID : formData.get('comment_post_ID'),
        comment_parent : formData.get('comment_parent')
    }
    const response = await fetch(uri, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': formData.get('_token')
        },
        body: JSON.stringify(data)
    })
    const message = await response.json()

    if(!message.success) {
        Object.keys(message.error).forEach((item) => {
            alert.classList.add('alert-danger')
            alert.insertAdjacentHTML('beforeend', `<span>${message.error[item]}</span><br>`)
        })
    }else {

        alert.classList.remove('alert-danger')
        alert.classList.add('alert-success')
        alert.innerHTML = message.success
        commentForm.reset()

        if(message.data.parent_id > 0) {
            document.querySelector(`#comment-${message.data.parent_id}`).insertAdjacentHTML('beforeend', message.comment)
            document.querySelector('#cancel-comment-reply-link').click()
        }else {
            form.insertAdjacentHTML('beforebegin', message.comment)
        }

    }
    showMessage(alert)
}

const sendMail = async (event) => {
    event.preventDefault()
    alert.innerHTML = ''

    const formData = new FormData(event.target)
    const url = event.target.action
    const data = {
        _token: formData.get('_token'),
        name: formData.get('name'),
        email: formData.get('email'),
        phone: formData.get('phone'),
        subject: formData.get('subject'),
        message: formData.get('message'),
    }
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': formData.get('_token')
        },
        body: JSON.stringify(data)
    })

    const answer = await response.json()
    if(answer.success) {
        alert.classList.remove('alert-danger')
        alert.classList.add('alert-success')
        alert.innerHTML = answer.success
        event.target.reset()
    }else {
        Object.keys(answer.error).forEach((item) => {
            alert.classList.add('alert-danger')
            alert.insertAdjacentHTML('beforeend', `<span>${answer.error[item]}</span><br>`)
        })
    }

    showMessage(alert)
}

const createOrder = async (event) => {
    event.preventDefault()

    alert.innerHTML = ''
    const formData = new FormData(event.target)
    const url = event.target.action
    const data = {
        _token: formData.get('_token'),
        name: formData.get('name'),
        email: formData.get('email'),
        phone: formData.get('phone'),
        address: formData.get('address'),
        comment: formData.get('comment'),
    }
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': formData.get('_token')
        },
        body: JSON.stringify(data)
    })

    const answer = await response.json()


    if(answer.success) {
        alert.classList.remove('alert-danger')
        alert.classList.add('alert-success')
        alert.innerHTML = answer.success
        event.target.reset()
        setTimeout(() => {
            location.href = 'http://fruitshop.loc/'
        }, 2000)
    }else {
        Object.keys(answer.error).forEach((item) => {
            console.log(answer.error[item])
            alert.classList.add('alert-danger')
            alert.insertAdjacentHTML('beforeend', `<span>${answer.error[item]}</span><br>`)
        })
    }

    showMessage(alert)


}





const addCount = document.querySelectorAll('#add-count-to-cart')
const add = document.querySelectorAll('#add-to-cart')
const remove = document.querySelectorAll('#remove-from-cart')
const update = document.querySelector('#updateCart')
const sendForm = document.querySelector('#send-mail')
const sendCheckout = document.querySelector('#sendCheckout')



if(sendCheckout) {
    sendCheckout.addEventListener('submit', createOrder)
}
if(commentForm) {
    commentForm.addEventListener('submit', sendComment)
}

if(sendForm) {
    sendForm.addEventListener('submit', sendMail)
}

if(update) {
    update.addEventListener('click', updateCart)
}
remove.forEach((item) => {
    item.addEventListener('submit', removeFromCart)
})
addCount.forEach((item) => {
    item.addEventListener('change', addToCart)
})
add.forEach((item) => {
    item.addEventListener('click', addToCart)
})








