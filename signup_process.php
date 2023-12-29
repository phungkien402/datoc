<?php
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

// Xử lý dữ liệu từ form đăng ký
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu (ví dụ: sử dụng hàm password_hash)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Thực hiện truy vấn để chèn dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Đăng ký thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
