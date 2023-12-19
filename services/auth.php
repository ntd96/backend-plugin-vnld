<?php

function getToken($email, $password)
{
    // URL của endpoint xác thực
    $auth_url = 'https://eshop.bizfly.vn/api/login'; 

    // Dữ liệu gửi đi, ví dụ: thông tin đăng nhập
    $data = array(
        'email' => $email, 
        'password' => $password,
    );

    // Khởi tạo cURL session
    $ch = curl_init();

    // Cấu hình các tùy chọn cURL
    curl_setopt($ch, CURLOPT_URL, $auth_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    

    // Thực hiện yêu cầu cURL và lấy phản hồi
    $response = curl_exec($ch);

    // Kiểm tra lỗi
    if ($response === false) {
        $error = curl_error($ch);
        // Xử lý lỗi ở đây
        return null;
    } else {
        // Xử lý phản hồi từ API ở đây
        // Phân tích phản hồi từ JSON sang mảng
        $result = json_decode($response, true);

        // Kiểm tra nếu có token trong phản hồi
        if (isset($result['token'])) {
            return $result['token'];
        } else {
            // Nếu không có token trong phản hồi
            // Xử lý thông báo lỗi hoặc trả về null
            return null;
        }
    }

    // Đóng session cURL
    curl_close($ch);
}

// Sử dụng hàm getToken để lấy token
$email = 'your_email@example.com';
$password = 'your_password';

$token = getToken($email, $password);

// Kiểm tra và sử dụng token nếu có
if ($token !== null) {
    echo "Token: " . $token;
    // Sử dụng token trong các yêu cầu API tiếp theo ở đây
} else {
    echo "Failed to get token!";
    // Xử lý lỗi ở đây nếu không lấy được token
}