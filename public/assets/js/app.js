let addToCart = (id) => {
    let params = new URLSearchParams()
    params.append('id', id)
    axios.post('/cart', params)
        .then(() => {
            location.replace(location.href)
        })
        .catch((e) => {
            console.log(e)
        })
}

let deleteFromCart = (key) => {
    let params = new URLSearchParams()
    params.append('key', key)
    axios.post('/cart/delete', params)
        .then(() => {
            location.replace(location.href)
        })
}