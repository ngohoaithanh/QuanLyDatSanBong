<?php 
    ob_start();
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once("Controller/cChuSan.php");
    $p = new ControllerChuSan();
    $maNV = $_REQUEST['id'];
    $nv = $p -> get01NhanVien($maNV);
    if($nv){
        while($r = mysqli_fetch_assoc($nv)){
            $tenNV = $r['TenNhanVien'];
            $email = $r['Email'];
            $sdt = $r['SDT'];
            $diachi = $r['DiaChi'];
            $sex = $r['GioiTinh'];
            $pass = $r['MatKhau'];
            $machusan = $r['MaChuSan'];
        }
    }else{
        echo "<script>alert('Nhân Viên Không Tồn Tại !!!')</script>";
        header("refresh:0; url='admin.php'");
    }
?>
<h2 align="center">Cập nhật nhân viên</h2>
<form action="#" method="post" enctype="multipart/form-data" class="form-container">
    <div class="form-group">
        <label for="TenNV">Tên Nhân Viên</label>
        <input type="text" id="TenNV" name="TenNV" required value="<?php if(isset($tenNV)) echo $tenNV; ?>">
        <small class="error-message" style="color: red; display: none;">Tên không hợp lệ!</small>
    </div>
    <div class="form-group">
        <label for="Email">Email</label>
        <input type="email" id="Email" name="Email" required value="<?php if(isset($email)) echo $email; ?>">
        <small class="error-message" style="color: red; display: none;">Email không hợp lệ!</small>
    </div>
    <div class="form-group">
        <label for="SDT">Số Điện Thoại</label>
        <input type="text" id="SDT" name="SDT" required value="<?php if(isset($sdt)) echo $sdt; ?>">
        <small class="error-message" style="color: red; display: none;">Số điện thoại không hợp lệ!</small>
    </div>
    <div class="form-group">
        <label for="DiaChi">Địa Chỉ</label>
        <input id="DiaChi" name="DiaChi" required value="<?php if(isset($diachi)) echo $diachi; ?>"></input>
        <small class="error-message" style="color: red; display: none;">Địa chỉ không hợp lệ!</small>
    </div>
    <div class="form-group">
        <label for="GioiTinh">Giới Tính</label>
        <select id="GioiTinh" name="GioiTinh" required>
            <option value="1" <?php echo (isset($sex) && $sex == 1) ? "selected" : ""; ?>>Nam</option>
            <option value="0" <?php echo (isset($sex) && $sex == 0) ? "selected" : ""; ?>>Nữ</option>
        </select>
    </div>

    <div class="form-group" style="position: relative;">
        <label for="MatKhau">Mật Khẩu</label>
        <input type="password" id="MatKhau" name="MatKhau" required value="<?php if(isset($pass)) echo $pass; ?>" style="padding-right: 40px;">
            <!-- Biểu tượng con mắt -->
            <span id="togglePassword" style="position: absolute; right: 10px; top: 40px; cursor: pointer;">
                👁️
            </span>
    </div>

    <div class="form-group" style="display: flex; justify-content: space-between;">
        <input type="submit" name="btncapnhat" value="Cập nhật">
        <input type="reset" value="Hủy" onclick="history.back();">
    </div>
</form>

<script>
    const togglePassword = document.getElementById("togglePassword");
    const passwordField = document.getElementById("MatKhau");

    togglePassword.addEventListener("click", function () {
        // Kiểm tra trạng thái của trường mật khẩu
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        // Thay đổi biểu tượng
        this.textContent = type === "password" ? "👁️" : "🙈";
    });
</script>

<script>
    // Regex cho từng loại kiểm tra
    const nameRegex = /^[A-ZÀÁÃẠẢĂẲẰẮẴẶÂẦẪẬẨẤÈẺÉẼẸÊỂẾỀỆỄÌỈÍỊĨÒỎÓỌÕÔỔỐỒỘỖỞƠỚỜỢỠÙÚỦŨỤĐƯỨỪỮỰỬỲỴÝỶỸ][a-zàáãạảăẳằắẵặâầẫậẩấèẻéẽẹêểếềệễìỉíịĩòỏóọõôổốồộỗởơớờợỡùúủũụđưứừữựửỳỵýỷỹ]*(\s[A-ZÀÁÃẠẢĂẲẰẮẴẶÂẦẪẬẨẤÈẺÉẼẸÊỂẾỀỆỄÌỈÍỊĨÒỎÓỌÕÔỔỐỒỘỖỞƠỚỜỢỠÙÚỦŨỤĐƯỪỨỮỰỬỲỴÝỶỸ][a-zàáãạảăẳằắẵặâầẫậẩấèẻéẽẹêểếềệễìỉíịĩòỏóọõôổốồộỗởơớờợỡùúủũụđưứừữựửỳỵýỷỹ]*)*$/u;
    const addressRegex = /^[a-zA-ZÀÁÃẠẢĂẲẰẮẴẶÂẦẪẬẨẤÈẺÉẼẸÊỂẾỀỆỄÌỈÍỊĨÒỎÓỌÕÔỔỐỒỘỖỞƠỚỜỢỠÙÚỨỦŨỤĐƯỪỮỰỬỲỴÝỶỸàáãạảăẳằắẵặâầẫậẩấèẻéẽẹêểếềệễìỉíịĩòỏóọõôổốồộỗởơớờợỡùúủũụđưứừữựửỳỵýỷỹ0-9\s,\/\.]+$/u;
    const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    const phoneRegex = /^(03|07|08|09)[0-9]{8}$/;

    // Hàm kiểm tra dữ liệu
    function validateField(input, regex, errorMessage) {
        const value = input.value.trim(); // Loại bỏ khoảng trắng thừa
        const errorElement = input.nextElementSibling;

        if (!regex.test(value)) {
            input.style.border = "2px solid red"; // Viền đỏ
            errorElement.style.display = "block"; // Hiển thị thông báo lỗi
            errorElement.innerText = errorMessage;
        } else {
            input.style.border = "2px solid green"; // Viền xanh lá cây
            errorElement.style.display = "none"; // Ẩn thông báo lỗi
        }
    }

    // Gán sự kiện blur cho từng ô nhập liệu
    document.getElementById("TenNV").addEventListener("blur", function () {
        validateField(this, nameRegex, "Tên không hợp lệ! Tên phải viết hoa chữ cái đầu và không chứa ký tự đặc biệt.");
    });

    document.getElementById("Email").addEventListener("blur", function () {
        validateField(this, emailRegex, "Email không hợp lệ! Vui lòng nhập đúng định dạng xxx@gmail.com.");
    });

    document.getElementById("SDT").addEventListener("blur", function () {
        validateField(this, phoneRegex, "Số điện thoại không hợp lệ! Vui lòng nhập 10 số với đầu số 03, 07, 08 hoặc 09.");
    });

    document.getElementById("DiaChi").addEventListener("blur", function () {
        validateField(this, addressRegex, "Địa chỉ không hợp lệ! Vui lòng nhập địa chỉ hợp lệ.");
    });
</script>

<?php
    if (isset($_REQUEST['btncapnhat'])) {
        $kq = $p->updateNhanVien($maNV, $_REQUEST['TenNV'], $_REQUEST['Email'], $_REQUEST['SDT'], $_REQUEST['DiaChi'], $_REQUEST['GioiTinh'], $_REQUEST['MatKhau'], $machusan);
        if ($kq) {
            echo "<script>alert('Cập nhật Nhân Viên thành công')</script>";
            header("refresh:0; url='admin.php?nhanvien'");
            ob_end_flush();
        } else {
            echo "<script>alert('Cập nhật Nhân Viên thất bại')</script>";
        }
    }
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding-left: 0;
        align-items: center;
        height: 100vh;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 400px;
        margin-left: 400px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
    }

    .form-group input[type="submit"],
    .form-group input[type="reset"] {
        width: 48%;
        cursor: pointer;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        padding: 10px;
        margin-right: 4%;
        background-color: #007bff;
        color: white;
        transition: background-color 0.3s ease;
    }

    .form-group input[type="reset"] {
        background-color: #6c757d;
    }

    .form-group input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .form-group input[type="reset"]:hover {
        background-color: #495057;
    }
</style>