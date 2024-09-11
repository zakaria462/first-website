let script1_openShopping = document.querySelector('#shopping');
let script1_closeShopping = document.querySelector('.closeShopping');
let script1_list = document.querySelector('.list');
let script1_listCard = document.querySelector('.listCard');
let script1_body = document.querySelector('body');
let script1_total = document.querySelector('.total');
let script1_quantity = document.querySelector('.quantity');
let script1_showsearch = document.querySelector(".bar-search");

script1_openShopping.addEventListener('click', () => {
    script1_body.classList.add('active');
});

script1_closeShopping.addEventListener('click', () => {
    script1_body.classList.remove('active');
});

function showbar() {
    script1_showsearch.classList.add("active");
}

function hideform(){
    script1_showsearch.classList.remove("active");
}

function toggleProfile() {
    var profilElement = document.getElementById('profil');
    profilElement.classList.toggle('active');
}

let script1_products = [];

function script1_getProductsFromDatabase() {
    fetch('get_products.php?table=camera')
        .then(response => response.json())
        .then(data => {
            script1_products = data;
            script1_initApp();
        })
        .catch(error => console.error('Error fetching products:', error));
}

function createProductElement(product) {
    let newDiv = document.createElement('div');
    newDiv.classList.add('item');
    newDiv.innerHTML = `
        <img src="${product.image}">
        <div class="title">${product.nom}</div>
        <div class="price">${product.prix.toLocaleString()} Dh</div>
        <button onclick="script1_addToCard(${product.id})">Add To Card</button>`;
    return newDiv;
}

let script1_listCards = {};

function script1_addToCard(productId) {
    const index = productId - 1;
    if (script1_products[index]) {
        if (!script1_listCards[index]) {
            script1_listCards[index] = { ...script1_products[index], quantity: 1 };
        } else {
            script1_listCards[index].quantity++;
        }
        script1_reloadCard();
        script1_saveProductsToCookies();
    }
}


function script1_reloadCard() {
    script1_listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    for (let key in script1_listCards) {
        let product = script1_listCards[key];
        totalPrice += product.prix * product.quantity;
        count += product.quantity;
        let newDiv = document.createElement('li');
        newDiv.innerHTML = `
            <div><img src="${product.image}"/></div>
            <div>${product.nom}</div>
            <div>${(product.prix * product.quantity).toLocaleString()} Dh</div>
            <div>
                <button style="width: 12px;" onclick="script1_changeQuantity(${key}, ${product.quantity - 1})">-</button>
                <div class="count">${product.quantity}</div>
                <button style="width: 12px;" onclick="script1_changeQuantity(${key}, ${product.quantity + 1})">+</button>
            </div>`;
        script1_listCard.appendChild(newDiv);
    }
    script1_total.innerText = totalPrice.toLocaleString() + ' Dh';
    script1_quantity.innerText = count;
}

function script1_changeQuantity(key, quantity) {
    if (quantity == 0) {
        delete script1_listCards[key];
    } else {
        script1_listCards[key].quantity = quantity;
    }
    script1_reloadCard();
    script1_saveProductsToCookies();
}

function script1_initApp() {
    script1_list.innerHTML = '';
    script1_products.forEach(product => {
        script1_list.appendChild(createProductElement(product));
    });
    script1_loadProductsFromCookies();
}

window.addEventListener('load', () => {
    script1_getProductsFromDatabase();
});

function script1_loadProductsFromCookies() {
    const storedProducts = JSON.parse(script1_getCookie('cartData1'));
    if (storedProducts) {
        script1_listCards = storedProducts;
        script1_reloadCard();
    }
}

function script1_saveProductsToCookies() {
    script1_setCookie('cartData1', JSON.stringify(script1_listCards), 7);
}

function script1_setCookie(name, value, days) {
    let expires = '';
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + (value || '') + expires + '; path=/';
}

function script1_getCookie(name) {
    let nameEQ = name + '=';
    let cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        while (cookie.charAt(0) === ' ') cookie = cookie.substring(1, cookie.length);
        if (cookie.indexOf(nameEQ) === 0) return cookie.substring(nameEQ.length, cookie.length);
    }
    return null;
}
