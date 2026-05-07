// Corrected Product Data (Ensuring proper price values)
const products = [
   { id: 1, name: "STYLISH WATCH", price: 1190, image: "https://www.titan.co.in/dw/image/v2/BKDD_PRD/on/demandware.static/-/Sites-titan-master-catalog/default/dw5dea78ac/images/Titan/Catalog/1639SM02_1.jpg?sw=360&sh=360", quantity: 1 },
   { id: 2, name: "BELT WATCH", price: 1200, image: "https://www.titan.co.in/dw/image/v2/BKDD_PRD/on/demandware.static/-/Sites-titan-master-catalog/default/dw3d890c5d/images/Fastrack/Catalog/3270SL03_1.jpg?sw=360&sh=360", quantity: 1 },
   { id: 3, name: "PUMA SHIRT", price: 1199, image: "https://lp2.hm.com/hmgoepprod?set=format%5Bwebp%5D%2Cquality%5B79%5D%2Csource%5B%2Fa0%2F95%2Fa0957a21103358f181547fab3ba20b2ac9114d61.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5Bmen_shirts_casual%5D%2Ctype%5BDESCRIPTIVESTILLLIFE%5D%2Cres%5Bm%5D%2Chmver%5B2%5D&call=url%5Bfile%3A%2Fproduct%2Fmain%5D", quantity: 1 },
   { id: 4, name: "R jacket", price: 1190, image: "https://lp2.hm.com/hmgoepprod?set=format%5Bwebp%5D%2Cquality%5B79%5D%2Csource%5B%2F79%2Fbe%2F79be6910c338175c2ced088b4fccb22168b28562.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BDESCRIPTIVESTILLLIFE%5D%2Cres%5Bm%5D%2Chmver%5B2%5D&call=url%5Bfile%3A%2Fproduct%2Fmain%5D", quantity: 1 },
   { id: 5, name: "Boots", price: 1300, image: "https://lp2.hm.com/hmgoepprod?set=quality%5B79%5D%2Csource%5B%2F40%2Ff8%2F40f826cef2a79ec733cc85ec156856d119d011ea.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BDESCRIPTIVESTILLLIFE%5D%2Cres%5Bm%5D%2Chmver%5B2%5D&call=url[file:/product/main]", quantity: 1 },
   { id: 6, name: "APPLE iphone", price: 145490, image: "https://m.media-amazon.com/images/I/61xJlx-3KDL._SX679_.jpg", quantity: 1 },
   { id: 7, name: "NIVI strom Bat", price: 1190, image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJhrRPmmvNSTNUS1AOImcz22x3xjNpRp1MZw&s", quantity: 1 },
   { id: 8, name: "Highlighter", price: 1000, image: "https://cdn.tirabeauty.com/v2/billowing-snowflake-434234/tira-p/wrkr/products/pictures/item/free/resize-w:494/1120009/sWdZ23UGhp-1120009-1.jpg", quantity: 1 },
];

// Function to format prices in INR
function formatPrice(price) {
   return `₹${price.toLocaleString('en-IN')}`; // Formats numbers in Indian number system
}

// Function to render cart items
function renderCart() {
   const cartItemsContainer = document.getElementById("cart-items");
   cartItemsContainer.innerHTML = "";

   let subtotal = 0;

   products.forEach((product) => {
      subtotal += product.price * product.quantity;

      const itemHTML = `
         <div class="cart-item">
            <img src="${product.image}" alt="${product.name}">
            <div class="item-details">
               <h5>${product.name}</h5>
               <p>${formatPrice(product.price)} each</p>
            </div>
            <div class="item-actions">
               <button class="btn btn-sm btn-outline-secondary" onclick="changeQuantity(${product.id}, -1)">-</button>
               <input type="text" value="${product.quantity}" readonly>
               <button class="btn btn-sm btn-outline-secondary" onclick="changeQuantity(${product.id}, 1)">+</button>
               <button class="btn btn-sm btn-danger ms-2" onclick="removeItem(${product.id})">Remove</button>
            </div>
         </div>
      `;

      cartItemsContainer.innerHTML += itemHTML;
   });

   updateCartSummary(subtotal);
}

// Function to update cart summary
function updateCartSummary(subtotal) {
   const tax = (subtotal * 0.05).toFixed(2); // 5% tax
   const total = (subtotal + parseFloat(tax)).toFixed(2);

   document.getElementById("subtotal").innerText = formatPrice(subtotal);
   document.getElementById("tax").innerText = formatPrice(tax);
   document.getElementById("total").innerText = formatPrice(total);
}

// Function to change item quantity
function changeQuantity(id, delta) {
   const product = products.find((item) => item.id === id);
   if (!product) return;

   product.quantity += delta;
   if (product.quantity < 1) product.quantity = 1;

   renderCart();
}

// Function to remove an item from the cart
function removeItem(id) {
   const index = products.findIndex((item) => item.id === id);
   if (index !== -1) products.splice(index, 1);

   renderCart();
}

// Initial render
renderCart();
