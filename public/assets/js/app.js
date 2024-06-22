var products = [];
let getProducts = () => {
    axios.get('/products')
        .then((response) => {
            alert('success');
            products = JSON.parse(response.data);
        })
        .catch((e) => {
            console.log(e);
        });
}

document.addEventListener('DOMContentLoaded', getProducts, false);