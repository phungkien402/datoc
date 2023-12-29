<?php
session_start();

// Kết nối đến cơ sở dữ liệu (VD: MySQL)
$servername = "localhost";
$username = "username"; // Thay bằng tên người dùng cơ sở dữ liệu
$password = "password"; // Thay bằng mật khẩu cơ sở dữ liệu
$dbname = "database"; // Thay bằng tên cơ sở dữ liệu

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý dữ liệu từ form đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn để lấy thông tin người dùng từ cơ sở dữ liệu
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username; // Lưu session của người dùng đã đăng nhập
            echo "Đăng nhập thành công!";
            // Chuyển hướng đến trang chính sau khi đăng nhập thành công
            header("Location: index.php");
        } else {
            echo "Sai tên đăng nhập hoặc mật khẩu!";
        }
    } else {
        echo "Sai tên đăng nhập hoặc mật khẩu!";
    }
}

$conn->close();
?>
