const cart = JSON.parse(sessionStorage.getItem("cart")) || [];
if (cart.length === 0) {
  location.href = "buyer.php";
}
const getCart = () => {
  let listing = ``;
  cart.map(
    ({ name, image, totalprice, quantity }, index) =>
      (listing += `
  <tr>
  <td>${name}</td>
  <td><img height="100px" width="100px" src="../assets/images/${image}"></td>
  <td>$${totalprice}</td>
  <td>
  <button class="quantity"  onclick="removeOne(${index})">-</button>
  ${quantity}
  <button  class="quantity" onclick="addOne(${index})">+</button>
  </td>
  <td><button class="placeorder" onclick="placeOrder(${index})">Place order</button></td>
  <td><button class="remove" onclick="removeItem(${index})">🗑</button></td>
  </tr>
  `)
  );
  document.querySelector("tbody").innerHTML = listing;
};
getCart();

function removeOne(id) {
  cart[id].quantity--;
  cart[id].totalprice = cart[id].totalprice - cart[id].price;
  sessionStorage.setItem("cart", JSON.stringify(cart));
  if (cart[id].quantity === 0) {
    const deleted = cart.filter((element, index, arr) => index !== id);
    sessionStorage.setItem("cart", JSON.stringify(deleted));
    location.reload();
  }
  getCart();
}
function addOne(id) {
  cart[id].quantity++;
  cart[id].totalprice = cart[id].totalprice + cart[id].price;
  sessionStorage.setItem("cart", JSON.stringify(cart));
  getCart();
}
async function placeOrder(id) {
  const item = cart[id];
  await fetch(
    "http://localhost/xyz/20dit089%20project/buyer/insertorder.php",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=utf-8",
      },
      body: JSON.stringify(item),
    }
  );
  const deleted = cart.filter((element, index) => index !== id);
  sessionStorage.setItem("cart", JSON.stringify(deleted));
  location.reload();
}
function removeItem(id) {
  const deleted = cart.filter((element, index) => index !== id);
  sessionStorage.setItem("cart", JSON.stringify(deleted));
  location.reload();
}
