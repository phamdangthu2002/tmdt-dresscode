function showUnderConstruction() {
    Swal.fire({
        title: "Chức năng đang phát triển",
        text: "Chức năng này hiện đang được phát triển. Vui lòng quay lại sau!",
        icon: "info",
        confirmButtonText: "OK",
    });
}

function showSearch() {
    Swal.fire({
        title: "Tìm kiếm",
        input: "text",
        inputPlaceholder: "Nhập từ khóa tìm kiếm...",
        showCancelButton: true,
        confirmButtonText: "Tìm kiếm",
        cancelButtonText: "Hủy",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Kết quả tìm kiếm",
                text: `Bạn đã tìm kiếm: ${result.value}`,
                icon: "success",
                confirmButtonText: "OK",
            });
        }
    });
}

function showWishlist() {
    Swal.fire({
        title: "Danh sách yêu thích",
        text: "Hiện tại danh sách yêu thích của bạn đang trống.",
        icon: "info",
        confirmButtonText: "OK",
    });
}

function addToWishlist(productName) {
    Swal.fire({
        title: "Thành công!",
        text: `${productName} đã được thêm vào danh sách yêu thích.`,
        icon: "success",
        confirmButtonText: "OK",
    });
}


function subscribeNewsletter() {
    Swal.fire({
        title: "Chức năng đang phát triển",
        text: "Tính năng này hiện chưa khả dụng. Vui lòng quay lại sau!",
        icon: "info",
        confirmButtonText: "OK",
    });
}

document.getElementById("btn-login").addEventListener("click", function () {
    document.getElementById("popup").classList.add("show");
});

document.querySelector(".close").addEventListener("click", function () {
    document.getElementById("popup").classList.remove("show");
});

window.onclick = function (event) {
    if (event.target === document.getElementById("popup")) {
        document.getElementById("popup").classList.remove("show");
    }
};

// Xử lý chuyển đổi giữa đăng nhập và đăng ký
document
    .getElementById("toggle-register")
    .addEventListener("click", function (event) {
        event.preventDefault();
        document.getElementById("login-form").style.display = "none";
        document.getElementById("register-form").style.display = "block";
    });

document
    .getElementById("toggle-login")
    .addEventListener("click", function (event) {
        event.preventDefault();
        document.getElementById("register-form").style.display = "none";
        document.getElementById("login-form").style.display = "block";
    });

let cart = [];

// Dữ liệu mẫu cho sản phẩm
const productData = {
    "Áo sơ mi nam": {
        image: "https://placehold.co/300x300",
        price: "550.000₫",
        description: "Chất liệu cao cấp, kiểu dáng hiện đại",
        reviews: 4,
        sizes: ["S", "M", "L", "XL"],
        colors: ["Đen", "Trắng", "Xanh"],
        materials: ["Cotton", "Polyester"],
        quantity: ["1", "2", "3", "4", "5"],
    },
    "Váy liền thân": {
        image: "https://placehold.co/300x300",
        price: "680.000₫",
        description: "Phong cách thanh lịch, thích hợp đi làm",
        reviews: 4.5,
        sizes: ["S", "M", "L"],
        colors: ["Đỏ", "Xanh", "Vàng"],
        materials: ["Polyester", "Silk"],
        quantity: ["1", "2", "3", "4", "5"],
    },
    "Quần jeans nam": {
        image: "https://placehold.co/300x300",
        price: "750.000₫",
        description: "Denim cao cấp, form slim fit",
        reviews: 5,
        sizes: ["M", "L", "XL"],
        colors: ["Xanh", "Đen"],
        materials: ["Denim", "Cotton"],
        quantity: ["1", "2", "3", "4", "5"],
    },
    "Áo khoác bomber": {
        image: "https://placehold.co/300x300",
        price: "950.000₫",
        description: "Thiết kế cá tính, giữ ấm tốt",
        reviews: 4.5,
        sizes: ["S", "M", "L", "XL"],
        colors: ["Đen", "Xám", "Xanh"],
        materials: ["Polyester", "Nylon"],
        quantity: ["1", "2", "3", "4", "5"],
    },
};
// Hiển thị giỏ hàng (popup)
function showCart() {
    document.getElementById("cartPopup").classList.add("show");
    document.getElementById("cartOverlay").classList.add("show");
}

// Đóng giỏ hàng (popup)
function closeCart() {
    document.getElementById("cartPopup").classList.remove("show");
    document.getElementById("cartOverlay").classList.remove("show");
}

function addToCart(productName) {
    if (!productData[productName]) {
        console.error("Sản phẩm không tồn tại!");
        return;
    }

    let existingItem = cart.find((item) => item.name === productName);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        let product = productData[productName];

        cart.push({
            name: productName,
            image: product.image,
            price: product.price,
            quantity: 1,
        });
    }

    updateCartUI();
}

function updateCartUI() {
    let cartList = document.getElementById("cartItems");
    let cartCount = document.getElementById("cartCount");

    cartList.innerHTML = "";
    cartCount.innerText = cart.length;

    // Hiển thị số lượng nếu có sản phẩm
    cartCount.classList.toggle("show", cart.length > 0);

    if (cart.length === 0) {
        cartList.innerHTML = "<p>Giỏ hàng trống</p>";
        return;
    }

    cart.forEach((item, index) => {
        let li = document.createElement("li");
        li.classList.add("cart-item");

        li.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <span>${item.name} - ${item.price} (x${item.quantity})</span>
            <span class="remove-item" onclick="removeFromCart(${index})">X</span>
        `;

        cartList.appendChild(li);
    });
}

function removeFromCart(index) {
    cart.splice(index, 1);
    updateCartUI();
}

function checkout() {
    Swal.fire({
        title: "Thanh toán",
        text: "Bạn sẽ được chuyển đến trang thanh toán.",
        icon: "success",
        confirmButtonText: "OK",
    }).then(() => {
        // Chuyển đến trang thanh toán
        window.location.href = "/checkout";
    });
}

function buyNow(productName) {
    const selectedSize = document.getElementById("quickViewModalSizes").value;
    Swal.fire({
        title: "Mua ngay!",
        text: `${productName} (Size: ${selectedSize}) đã được thêm vào giỏ hàng. Bạn sẽ được chuyển đến trang thanh toán.`,
        icon: "success",
        confirmButtonText: "OK",
    }).then(() => {
        // Chuyển đến trang thanh toán
        window.location.href = "/checkout";
    });
}

function showCategoryProducts(categoryName) {
    Swal.fire({
        title: `Danh mục: ${categoryName}`,
        text: "Danh sách sản phẩm thuộc danh mục này sẽ được hiển thị ở đây.",
        icon: "info",
        confirmButtonText: "OK",
    });
}

function loadMoreProducts() {
    Swal.fire({
        title: "Đang tải thêm sản phẩm...",
        text: "Các sản phẩm mới sẽ được hiển thị ngay sau khi tải xong.",
        icon: "info",
        confirmButtonText: "OK",
    });
}

function copyPromoCode(code) {
    navigator.clipboard.writeText(code).then(() => {
        Swal.fire({
            title: "Thành công!",
            text: `Mã khuyến mãi ${code} đã được sao chép.`,
            icon: "success",
            confirmButtonText: "OK",
        });
    });
}

function showFlashSale() {
    Swal.fire({
        title: "Flash Sale",
        text: "Danh sách sản phẩm Flash Sale sẽ được hiển thị ở đây.",
        icon: "info",
        confirmButtonText: "OK",
    });
}

function showShippingPolicy() {
    Swal.fire({
        title: "Chính sách vận chuyển",
        text: "Thông tin chi tiết về chính sách vận chuyển sẽ được hiển thị ở đây.",
        icon: "info",
        confirmButtonText: "OK",
    });
}
