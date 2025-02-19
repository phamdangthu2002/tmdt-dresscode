<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .auth-container {
            width: 350px;
            padding: 30px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .toggle-link {
            margin-top: 10px;
            color: #007bff;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
        }

        .toggle-link:hover {
            text-decoration: underline;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .form-control {
            padding-left: 35px;
        }
    </style>
</head>

<body>

    <div class="auth-container" id="auth-box">
        <h2 id="auth-title">Đăng nhập</h2>

        <form id="login-form">
            <div class="mb-3 input-group">
                <i class="bx bx-envelope"></i>
                <input type="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3 input-group">
                <i class="bx bx-lock"></i>
                <input type="password" class="form-control" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
            <p class="toggle-link" onclick="toggleForm()">Chưa có tài khoản? Đăng ký ngay</p>
        </form>

        <form id="register-form" style="display: none;">
            <div class="mb-3 input-group">
                <i class="bx bx-user"></i>
                <input type="text" class="form-control" placeholder="Họ và tên" required>
            </div>
            <div class="mb-3 input-group">
                <i class="bx bx-envelope"></i>
                <input type="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3 input-group">
                <i class="bx bx-lock"></i>
                <input type="password" class="form-control" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
            <p class="toggle-link" onclick="toggleForm()">Đã có tài khoản? Đăng nhập ngay</p>
        </form>
    </div>

    <script>
        function toggleForm() {
            let loginForm = document.getElementById("login-form");
            let registerForm = document.getElementById("register-form");
            let authTitle = document.getElementById("auth-title");

            if (loginForm.style.display === "none") {
                loginForm.style.display = "block";
                registerForm.style.display = "none";
                authTitle.innerText = "Đăng nhập";
            } else {
                loginForm.style.display = "none";
                registerForm.style.display = "block";
                authTitle.innerText = "Đăng ký";
            }
        }
    </script>

</body>

</html>
