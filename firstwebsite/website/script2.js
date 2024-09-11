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
    fetch('get_products.php?table=pc')
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
    const storedProducts = JSON.parse(getCookie('cartData'));
    if (storedProducts) {
        listCards = storedProducts;
        reloadCard();
    }
}

function saveProductsToCookies() {
    setCookie('cartData', JSON.stringify(listCards), 7); // Utilisez 'cartData' au lieu de 'products2'
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


  function getOrderDetails() {
    // 1. Get product details from the DOM
    var productListItems = document.querySelectorAll('.item');
    var products = [];
  
    productListItems.forEach(function(item) {
      var productId = item.dataset.productId;
      var productName = item.querySelector('.title').textContent;
      var productPrice = parseFloat(item.querySelector('.price').textContent);
      var productQuantity = 1; // Par défaut, chaque produit est ajouté une fois dans la commande
  
      var product = {
        id: productId,
        name: productName,
        price: productPrice,
        quantity: productQuantity
      };
  
      products.push(product);
    });
  
    // 2. Calculate total amount
    var total = products.reduce(function(acc, curr) {
      return acc + (curr.price * curr.quantity);
    }, 0);
  
    // 3. Get additional order details (optional)
    // Ajoutez ici d'autres détails de commande tels que les informations de l'utilisateur, l'adresse de livraison, etc.
  
    var orderDetails = {
      products: products,
      total: total
    };
  
    return orderDetails;
}
