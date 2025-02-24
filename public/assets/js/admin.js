$(document).ready(function () {
    $("#categoryTable").DataTable({
        language: {
            lengthMenu: "Hiển thị _MENU_ mục",
            zeroRecords: "Không tìm thấy kết quả",
            info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
            infoEmpty: "Không có mục nào",
            infoFiltered: "(lọc từ _MAX_ mục)",
            search: "Tìm kiếm:",
            paginate: {
                first: "Đầu",
                last: "Cuối",
                next: "Tiếp",
                previous: "Trước",
            },
        },
    });
});

function editCategory(event) {
    event.preventDefault();
    Swal.fire({
        title: "Chỉnh sửa danh mục",
        text: "Chức năng chỉnh sửa chưa được triển khai.",
        icon: "info",
        confirmButtonText: "OK",
    });
}

function deleteCategory(event) {
    event.preventDefault();
    Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Bạn sẽ không thể hoàn tác hành động này!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Có, xóa nó!",
        cancelButtonText: "Hủy",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Đã xóa!", "Danh mục đã được xóa.", "success");
            // Thực hiện hành động xóa ở đây
            event.target.submit();
        }
    });
}

function toggleSidebar() {
    let sidebar = document.getElementById("sidebar");
    let isMobile = window.innerWidth <= 767;

    if (isMobile) {
        sidebar.classList.toggle("show");
        document.body.classList.toggle("no-scroll");

        if (sidebar.classList.contains("show")) {
            document.body.addEventListener("click", closeSidebarOutside, true);
        } else {
            document.body.removeEventListener(
                "click",
                closeSidebarOutside,
                true
            );
        }
    } else {
        sidebar.classList.toggle("collapsed");
    }
}

function closeSidebarOutside(event) {
    let sidebar = document.getElementById("sidebar");
    let toggleBtn = document.querySelector(".toggle-btn");

    if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
        sidebar.classList.remove("show");
        document.body.removeEventListener("click", closeSidebarOutside, true);
    }
}
