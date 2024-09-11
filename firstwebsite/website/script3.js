let openShopping = document.querySelector('#shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');
let showsearch = document.querySelector(".bar-search");

openShopping.addEventListener('click', () => {
    body.classList.add('active');
});

closeShopping.addEventListener('click', () => {
    body.classList.remove('active');
});
function showbar() {
    showsearch.classList.add("active");
}

function hideform(){
    showsearch.classList.remove("active");
}

function toggleProfile() {
    var profilElement = document.getElementById('profil');
    profilElement.classList.toggle('active');
}
let products = [];

function getProductsFromDatabase() {
    fetch('get_products.php?table=accessoires')
        .then(response => response.json())
        .then(data => {
            products = data;
            initApp();
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
        <button onclick="addToCard(${product.id})">Add To Card</button>`;
    return newDiv;
}

let listCards = {};

function addToCard(productId) {
    const index = productId - 1;
    if (products[index]) {
        if (!listCards[index]) {
            listCards[index] = { ...products[index], quantity: 1 };
        } else {
            listCards[index].quantity++;
        }
        reloadCard();
        saveProductsToCookies();
    }
}


function reloadCard() {
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    for (let key in listCards) {
        let product = listCards[key];
        totalPrice += product.prix * product.quantity; 
        count += product.quantity;
        let newDiv = document.createElement('li');
        newDiv.innerHTML = `
            <div><img src="${product.image}"/></div>
            <div>${product.nom}</div>
            <div>${(product.prix * product.quantity).toLocaleString()} Dh</div>
            <div>
                <button style="width: 12px;" onclick="changeQuantity(${key}, ${product.quantity - 1})">-</button>
                <div class="count">${product.quantity}</div>
                <button style="width: 12px;" onclick="changeQuantity(${key}, ${product.quantity + 1})">+</button>
            </div>`;
        listCard.appendChild(newDiv);
    }
    total.innerText = totalPrice.toLocaleString() + ' Dh';
    quantity.innerText = count;
}


function changeQuantity(key, quantity) {
    if (quantity == 0) {
        delete listCards[key];
    } else {
        listCards[key].quantity = quantity;
    }
    reloadCard();
    saveProductsToCookies();
}


function initApp() {
    list.innerHTML = '';
    products.forEach(product => {
        list.appendChild(createProductElement(product));
    });
    loadProductsFromCookies();
}


window.addEventListener('load', () => {
    getProductsFromDatabase();
});

function loadProductsFromCookies() {
    const storedProducts = JSON.parse(getCookie('cartData3'));
    if (storedProducts) {
        listCards = storedProducts;
        reloadCard();
    }
}


function saveProductsToCookies() {
    setCookie('cartData3', JSON.stringify(listCards), 7);
}


function setCookie(name, value, days) {
    let expires = '';
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + (value || '') + expires + '; path=/';
}

// Fonction pour obtenir la valeur d'un cookie
function getCookie(name) {
    let nameEQ = name + '=';
    let cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        while (cookie.charAt(0) === ' ') cookie = cookie.substring(1, cookie.length);
        if (cookie.indexOf(nameEQ) === 0) return cookie.substring(nameEQ.length, cookie.length);
    }
    return null;
}
