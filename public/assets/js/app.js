var products = [];
let getProducts = () => {
    axios.get('/products')
        .then((response) => {
            alert(response.data);
        })
        .catch((e) => {
            console.log(e);
        });
}

document.addEventListener('DOMContentLoaded', getProducts, false);