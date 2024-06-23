var products = []
let addToCart = (product) => {
    axios.post('/cart', product)
        .catch((e) => {
            console.log(e)
        })
}

let deleteFromCart = (id) => {
    axios.delete('/cart', {id})
        .then(() => {
            location.reload()
        })
}

document.addEventListener('DOMContentLoaded', getCart, false)