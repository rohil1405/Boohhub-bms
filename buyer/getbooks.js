const cart = JSON.parse(sessionStorage.getItem("cart")) || [];

const viewCart = document.getElementsByClassName("cartbtn")[0];
viewCart.textContent = `Viewcart(${cart.length})`;
viewCart.addEventListener("click", () => {
  location.href = "viewcart.php";
});

const getAllBooks = async () => {
  try {
    const response = await fetch(
      `http://localhost/xyz/20dit089%20project/buyer/getallbooks.php`
    );
    const books = await response.json();
    let book = ``;
    books.map(
      ({ id, name, image }) =>
      (book += `
  <div class="col-3">
  <div class="card">
  <img src="../assets/images/${image}" height="200px" width="200px" class="card-img-top" alt="${name}">
  <div class="card-body">
    <h5 class="card-title">${name.toUpperCase()}</h5>
  <button onclick="viewDetails(${id})" type="button"  class="cartbtn" data-bs-toggle="modal" data-bs-target="#exampleModal_${id}">Viewdetails</button>
  </div>
  </div>
</div>
`)
    );
    document.querySelector(".row").innerHTML = book;
  } catch (error) {
    console.log(error);
  }
};
getAllBooks();

async function addToCart(bid) {
  try {
    const data = await fetch(
      `http://localhost/xyz/20dit089%20project/buyer/getonebook.php?id=${bid}`
    );
    const book = await data.json();
    const bookCart = {
      id: parseInt(book.id),
      name: book.name,
      image: book.image,
      buyerId: parseInt(sessionStorage.getItem("id")),
      price: parseInt(book.price),
      totalprice: parseInt(book.price),
      sellerId: parseInt(book.seller_id),
      quantity: 1,
    };
    const findId = cart.findIndex((element) => element.id == bid);
    if (findId != -1) {
      cart[findId].quantity++;
      cart[findId].totalprice = cart[findId].totalprice + cart[findId].price;
    } else {
      setTimeout(() => {
        alert(`Add to cart successfully`);
        cart.unshift(bookCart);
        sessionStorage.setItem("cart", JSON.stringify(cart));
        location.reload();
      }, 500);
    }
  } catch (error) {
    console.log(error);
  }
}
async function viewDetails(bid) {
  const result = await fetch(`http://localhost/xyz/20dit089%20project/buyer/getonebook.php?id=${bid}`);
  const data = await result.json();
  const { name, price, author, description, image } = data;
  const modal = `
    <div class="modal fade" id="exampleModal_${bid}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-body">
          <center>
          <img src="../assets/images/${image}" height=250px" width="200px" class="card-img-top" alt="${name}">
          <div>
          <i class="card-title"><b>BOOKNAME:</b>${name}</i>
          </div>
          <div>
          <i class="card-title"><b>PRICE:</b>$${price}</i>
          </div>
          <div>
          <i class="card-title"><b>AUTHOR:</b>${author}</i>
          </div>
          <div>
          <i class="card-text"><b>DESCRIPTION</b>:${description}</i>
          </div>
          <br>
          <div>
          <button onclick="addToCart(${bid})" type="button" class="btn btn-danger">🛒Add to cart</button>
          <button type="button"  class="cartbtn" data-dismiss="modal">Close</button>
          </div>
          </center>
          </div>
        </div>
      </div>
    </div>
  `;
  document.body.insertAdjacentHTML('beforeend', modal);
  const myModal = new bootstrap.Modal(document.getElementById(`exampleModal_${bid}`));
  myModal.show();
}