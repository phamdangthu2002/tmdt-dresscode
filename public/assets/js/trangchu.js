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
