let addToCart = (id) => {
    axios.post('/cart', { id })
        .catch((e) => {
            console.log(e)
        })
}

let deleteFromCart = (id) => {
    axios.delete('/cart', { id })
        .then(() => {
            location.reload()
        })
}