<form method="post" action="">
    Name: <input type="text" name="name"><br>
    Email: <input type="text" name="email"><br>
    Address: <input type="text" name="address"><br>
    <input type="submit" value="Submit">
</form>

<script>
    function submitForm(event) {
        event.preventDefault();

        var formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            address: document.getElementById('address').value
        };

        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
            .then(response => response.text())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>



<?php
function console_log($data)
{
    $output = "<script>console.log( 'PHP debugger: ";
    $output .= json_encode(print_r($data, true));
    $output .= "' );</script>";
    echo $output;
}

// Xử lý dữ liệu từ POST request nếu có
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    echo " $name , $email, $address ";
    console_log($name);
    console_log($email);
    console_log($address);

    // Sử dụng hàm getToken để lấy token
    $token = getToken('your_email@example.com', 'your_password');
    // Kiểm tra và sử dụng token nếu có
    if ($token !== null) {
        // Gọi hàm sendForm để gửi form với token đã lấy được
        sendForm($token, $name, $email, $address);
    } else {
        echo "Failed to get token!";
        // Xử lý lỗi ở đây nếu không lấy được token
    }
}

