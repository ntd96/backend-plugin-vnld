<?php

// Hàm để gửi form đến API bên thứ ba với token được lấy từ hàm getToken
function sendForm($token ,$name, $email, $address)
{
    // Dữ liệu gửi đi định dạng theo yêu cầu của API
    $data = array(
        'name' => $name,
        'email' => $email,
        'address' => $address
        // Các trường dữ liệu khác cần gửi đi theo yêu cầu của API
    );

    // Khởi tạo cURL session
    $ch = curl_init();

    // Cấu hình các tùy chọn cURL
    curl_setopt($ch, CURLOPT_URL, 'https://eshop.bizfly.vn/customer/store-livechat');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    ));

    // Thực hiện yêu cầu cURL và lấy phản hồi
    $response = curl_exec($ch);

    // Kiểm tra lỗi
    if ($response === false) {
        $error = curl_error($ch);
        // Xử lý lỗi ở đây
        echo "Error: " . $error;
    } else {
        // Xử lý phản hồi từ API ở đây
        echo "Data sent successfully!";
        var_dump($response); // In ra phản hồi từ API (có thể xóa dòng này sau khi bạn đã kiểm tra phản hồi)
    }

    // Đóng session cURL
    curl_close($ch);
}

