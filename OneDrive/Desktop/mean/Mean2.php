<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kairo&family=DGaza&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: logo;
            src: url('alfont_com_DG-Gaza (1).ttf');
        }
        body {
            font-family: "Cairo", sans-serif;
            direction: rtl; /* جعل النص يبدأ من اليمين إلى اليسار */
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            font-family: logo;
        }
        .content-box {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 10px;
            margin-top: 40px;
            text-align: right; /* محاذاة النص لليمين */
        }
        .content-box img {
            max-width: 300px; /* عرض الصورة */
            margin-left: 50px;
        }
        .card {
            border-radius: 15px;
            max-width: 250px; /* تصغير عرض الكارد */
        }
        .scrollable-section {
            max-height: 430px; /* ارتفاع الجزء القابل للتمرير */
            overflow-y: scroll; /* تفعيل التمرير العمودي */
            overflow-x: hidden; /* تفعيل التمرير الأفقي إذا لزم الأمر */
            border-radius: 10px;
            padding: 10px;
            margin-top: 20px;
            text-align: right; /* محاذاة النص لليمين */
            border: rgba(128, 128, 128, 0.318) solid 2px;
            border-radius: 10px;
   
        }
        /* إخفاء شريط التمرير */
.scrollable-section::-webkit-scrollbar {
    display: none; /* إخفاء شريط التمرير */
}
        .footer {
            text-align: center;
            padding: 10px;
            margin-top: 30px;
            background-color: #1A4500;
            color:#D9D9D9;
            border-top: 1px solid #ccc;
        }
        /* زر الشات */
        .chat-button {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background-color: #1A4500;
            color: white;
            border: none;
            border-radius: 50px; /* حواف ناعمة */
            padding: 10px 15px;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000; /* تأكد من ظهور الزر فوق العناصر الأخرى */
        }
        .chat-button:hover {
            background-color: #3A7239; /* لون الزر عند التمرير عليه */
        }
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
            width: 400px; /* زيادة عرض الشات */
            max-height: 500px; /* زيادة ارتفاع الشات */
            z-index: 1000;
        }
        .chat-header {
            background-color:  #3A7239;
            color: white;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }
        .chat-body {
            padding: 10px;
            max-height: 400px;
            overflow-y: auto;
        }
        .chat-input {
            display: flex;
        }
        .chat-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
        }
        .chat-input button {
            padding: 10px;
            background-color: #1A4500;
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
        .chat-input button:hover {
            background-color: #3A7239;
        }
        .user-message {
            text-align: left; /* نص المستخدم على اليسار */
            margin: 5px 0;
        }
        .bot-message {
            text-align: right; /* نص البوت على اليمين */
            margin: 5px 0;
        }
        .loading {
            display: none; /* إخفاء شاشة التحميل بشكل افتراضي */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            text-align: center;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            font-size: 24px;
        }
    </style>
</head>
<body>
   <div class=loading id=loading>جاري التحميل...</div>
    <header class="header" style="padding-top: 20px;">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">معًا</div>
            <div>
                <button class="btn btn-custom mr-2" style="background-color: #1A4500; color: white;" data-toggle="modal" data-target="#loginModal">تسجيل دخول</button>
                <!-- بوب اب تسجيل دخول -->
                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">تسجيل دخول</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="loginForm" method="POST">
                                    <div class="form-group">
                                        <label for="loginEmail">البريد الإلكتروني أو الاسم</label>
                                        <input type="text" class="form-control" id="loginEmail" name="loginEmail" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="loginPassword">كلمة المرور</label>
                                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
                                    </div>
                                  
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="loginSubmit" class="btn btn-primary" onclick="performLogin()">تسجيل الدخول</button>
                            </form>
                          


                            </div>
                        </div>
                    </div>
                </div>
                <!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kairo&family=DGaza&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: logo;
            src: url('alfont_com_DG-Gaza (1).ttf');
        }
        body {
            font-family: "Cairo", sans-serif;
            direction: rtl; /* جعل النص يبدأ من اليمين إلى اليسار */
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            font-family: logo;
        }
        .content-box {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 10px;
            margin-top: 40px;
            text-align: right; /* محاذاة النص لليمين */
        }
        .content-box img {
            max-width: 300px; /* عرض الصورة */
            margin-left: 50px;
        }
        .card {
            border-radius: 15px;
            max-width: 250px; /* تصغير عرض الكارد */
        }
        .scrollable-section {
            max-height: 430px; /* ارتفاع الجزء القابل للتمرير */
            overflow-y: scroll; /* تفعيل التمرير العمودي */
            overflow-x: hidden; /* تفعيل التمرير الأفقي إذا لزم الأمر */
            border-radius: 10px;
            padding: 10px;
            margin-top: 20px;
            text-align: right; /* محاذاة النص لليمين */
            border: rgba(128, 128, 128, 0.318) solid 2px;
            border-radius: 10px;
   
        }
        /* إخفاء شريط التمرير */
.scrollable-section::-webkit-scrollbar {
    display: none; /* إخفاء شريط التمرير */
}
        .footer {
            text-align: center;
            padding: 10px;
            margin-top: 30px;
            background-color: #1A4500;
            color:#D9D9D9;
            border-top: 1px solid #ccc;
        }
        /* زر الشات */
        .chat-button {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background-color: #1A4500;
            color: white;
            border: none;
            border-radius: 50px; /* حواف ناعمة */
            padding: 10px 15px;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000; /* تأكد من ظهور الزر فوق العناصر الأخرى */
        }
        .chat-button:hover {
            background-color: #3A7239; /* لون الزر عند التمرير عليه */
        }
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
            width: 400px; /* زيادة عرض الشات */
            max-height: 500px; /* زيادة ارتفاع الشات */
            z-index: 1000;
        }
        .chat-header {
            background-color:  #3A7239;
            color: white;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }
        .chat-body {
            padding: 10px;
            max-height: 400px;
            overflow-y: auto;
        }
        .chat-input {
            display: flex;
        }
        .chat-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
        }
        .chat-input button {
            padding: 10px;
            background-color: #1A4500;
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
        .chat-input button:hover {
            background-color: #3A7239;
        }
        .user-message {
            text-align: left; /* نص المستخدم على اليسار */
            margin: 5px 0;
        }
        .bot-message {
            text-align: right; /* نص البوت على اليمين */
            margin: 5px 0;
        }
        .loading {
            display: none; /* إخفاء شاشة التحميل بشكل افتراضي */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            text-align: center;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            font-size: 24px;
        }
        #loading {
            display: none; 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(255, 255, 255, 0.8); 
            z-index: 1000; 
            justify-content: center; 
            align-items: center;
        }
    </style>
</head>
<body>
<div id="loading">
        <h2>جاري التحميل...</h2>
    </div>
    <header class="header" style="padding-top: 20px;">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">معًا</div>
            <div>
                <button class="btn btn-custom mr-2" style="background-color: #1A4500; color: white;" data-toggle="modal" data-target="#loginModal">تسجيل دخول</button>
                <!-- بوب اب تسجيل دخول -->
                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">تسجيل دخول</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="loginForm" method="POST">
                                    <div class="form-group">
                                        <label for="loginEmail">البريد الإلكتروني أو الاسم</label>
                                        <input type="text" class="form-control" id="loginEmail" name="loginEmail" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="loginPassword">كلمة المرور</label>
                                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
                                    </div>
                                  
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="loginSubmit" class="btn btn-primary" onclick="performLogin()">تسجيل الدخول</button>
                            </form>
                          


                            </div>
                        </div>
                    </div>
                </div>
                <?php 
    

    // إعداد معلومات الاتصال بقاعدة البيانات
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "mean_r";

    // إنشاء اتصال بقاعدة البيانات
    $conn = new mysqli($servername, $username, $password, $dbname);

    // التحقق من حالة الاتصال
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    // تفعيل عرض الأخطاء
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // التحقق مما إذا كان تم إرسال النموذج
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginSubmit'])) {
        $loginEmail = $_POST['loginEmail'];
        $loginPassword = $_POST['loginPassword'];

        // استعلام لاسترجاع بيانات المستخدم
        $stmt = $conn->prepare("SELECT name, password FROM users WHERE email = ?");
        if (!$stmt) {
            die("خطأ في الاستعلام: " . $conn->error);
        }

        $stmt->bind_param("s", $loginEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        // التحقق مما إذا كان هناك مستخدم مطابق
        if ($row = $result->fetch_assoc()) {
            // التحقق من كلمة المرور
            if (password_verify($loginPassword, $row['password'])) {
                $_SESSION['loginSubmit'] = true; 
                $_SESSION['username'] = $row['name']; 

                echo "<script>
                    document.getElementById('loading').style.display = 'flex';
                    setTimeout(() => {
                        window.location.href = 'mean-Home.php'; 
                    }, 1000); 
                </script>";
            } else {
                echo '<script>
                    window.alert("كلمة المرور غير صحيحة.");
                </script>';
            }
        } else {
            echo '<script>
                window.alert("لا يوجد مستخدم بهذا البريد الإلكتروني.");
            </script>';
        }

        $stmt->close();
    }

    $conn->close(); // إغلاق الاتصال بقاعدة البيانات
    ?>
                <button class="btn btn-custom" style="background-color: #1A4500; color: white;" data-toggle="modal" data-target="#registerModal">تسجيل جديد</button>
                <!-- بوب اب تسجيل جديد -->
                <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="registerModalLabel">تسجيل جديد</h5>
                             
                            </div>
                            <div class="modal-body">
                                <form id="registerForm" method="POST">
                                    <div class="form-group">
                                        <label for="name">الاسم</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">البريد الإلكتروني</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">رقم الجوال</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">كلمة المرور</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm-password">تأكيد كلمة المرور</label>
                                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="agree" name="agree" required>
                                        <label class="form-check-label" for="agree">أوافق على الشروط</label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                <button type="submit" name="submit" class="btn btn-primary">تسجيل</button>
                                
                            </form>
                         

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
	</header>
	<?php
                            // إعداد الاتصال بقاعدة البيانات
                            $servername = "localhost"; // أو عنوان السيرفر الخاص بك
                            $username = "root"; // اسم المستخدم لقاعدة البيانات
                            $password = ""; // كلمة سر قاعدة البيانات فارغة
                            $dbname = "mean_r"; // اسم قاعدة البيانات
                            
                            // إنشاء الاتصال
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            
                            // التحقق من الاتصال
                            if ($conn->connect_error) {
                                die("فشل الاتصال: " . $conn->connect_error);
                            }
                            
                            // التحقق من وجود بيانات POST
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                                // الحصول على البيانات من النموذج
                                $name = $conn->real_escape_string($_POST['name']);
                                $email = $conn->real_escape_string($_POST['email']);
                                $phone = $conn->real_escape_string($_POST['phone']);
                                $password = $conn->real_escape_string($_POST['password']);
                                $confirm_password = $conn->real_escape_string($_POST['confirm-password']);
                            
                                // التحقق من أن جميع الحقول قد تم ملؤها
                                if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
                                    die("يرجى ملء جميع الحقول.");
                                }
                            
                                // التحقق من أن كلمة المرور وتأكيد كلمة المرور متطابقتان
                                if ($password !== $confirm_password) {
                                    die("كلمة المرور وتأكيد كلمة المرور لا يتطابقان.");
                                }
                            
                                // التحقق من أن البريد الإلكتروني المدخل صالح
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    echo '<script>
window.alert(البريد الإلكتروني المدخل غير صالح.);
</script>'; 
								  
								  
                                }
                            
                                // التحقق من عدم تكرار البريد الإلكتروني ورقم الهاتف
                                $checkEmail = "SELECT * FROM users WHERE email='$email'";
                                $resultEmail = $conn->query($checkEmail);
                            
                                if ($resultEmail->num_rows > 0) {
                                                                echo '<script>
window.alert(البريد الإلكتروني مستخدم بالفعل.);
</script>'; 
								  
                                }
                            
                                $checkPhone = "SELECT * FROM users WHERE phone='$phone'";
                                $resultPhone = $conn->query($checkPhone);
                            
                                if ($resultPhone->num_rows > 0) {
                                    echo '<script>
window.alert(رقم الهاتف مستخدم بالفعل.);
</script>';
								   
                                }
                            
                                // تشفير كلمة المرور
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            
                                // إدخال البيانات في قاعدة البيانات
                                $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashed_password')";
                            
                                if ($conn->query($sql) === TRUE) {
                                   echo '<script>
window.alert(تم تسجيل البيانات بنجاح.);
</script>';
								   
                                } else {
                                    echo "خطأ: " . $sql . "<br>" . $conn->error;
                                }
                            }
                            
                            // إغلاق الاتصال
                            $conn->close();
                            ?>
   

    <div class="container mt-5 ">
        <div class="content-box"  style="background-color: #D9D9D9;">
            <div class="text-section">
                <h1 style="font-weight: bolder; font-size: 50px;">يدا بيد معًا لعونك</h1>
                <p>لديك سيارة مفقودة؟ لا تتردد، أبلغنا وسنكون هنا لمساعدتك!</p>
                <button class="btn btn-primary" style="border-radius: 10px; background-color: #1A4500; border: none;" data-toggle="modal" data-target="#reportModal" disabled>إنشاء بلاغ</button>
            </div>
            <img src="_2c86ea53-ad11-431a-aec9-6d8e8d2.png" alt="صورة" class="img-fluid mr-31" style="margin-right: auto ;">
        </div>
<!-- بوب اب إنشاء بلاغ -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">إنشاء بلاغ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="carImage">صورة السيارة</label>
                        <input type="file" class="form-control" id="carImage" required>
                    </div>
                    <div class="form-group">
                        <label for="carType">نوع السيارة</label>
                        <input type="text" class="form-control" id="carType" required>
                    </div>
                    <div class="form-group">
                        <label for="carPlate">لوحة السيارة</label>
                        <input type="text" class="form-control" id="carPlate" required>
                    </div>
                    <div class="form-group">
                        <label for="carColor">لون السيارة</label>
                        <input type="text" class="form-control" id="carColor" required>
                    </div>
                    <div class="form-group">
                        <label for="location">المكان</label>
                        <input type="text" class="form-control" id="location" required>
                    </div>
                    <div class="form-group">
                        <label for="reward">هل يوجد مكافأة؟</label>
                        <select class="form-control" id="reward" required>
                            <option value="نعم">نعم</option>
                            <option value="لا">لا</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary">إرسال البلاغ</button>
            </div>
        </div>
    </div>
</div>

        <div class="scrollable-section">
            <div class="row" id="card-container">
 



              
              <?php
// إعداد الاتصال بقاعدة البيانات
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "mean_r"; 


// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");
// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// استعلام لجلب البيانات
$sql = "SELECT * FROM reports";
$result = $conn->query($sql);

// التحقق مما إذا كانت هناك نتائج
if ($result->num_rows > 0) {
    echo '<div class="row">'; // بدء صف Bootstrap
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card mx-auto">';
        echo '<img src="' . $row['car_image'] . '" class="card-img-top" alt="صورة السيارة">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($row['car_type']) . '</h5>';
        echo 'الموقع: ' . htmlspecialchars($row['location']) . '<br>';
        echo 'المكافأة: ' . htmlspecialchars($row['reward']) . '<br>';
        echo 'تاريخ الإنشاء: ' . htmlspecialchars($row['created_at']) . '</p>';
        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contentModal" disabled>عرض</button>';
        echo '</div>'; // نهاية card-body
        echo '</div>'; // نهاية card
        echo '</div>'; // نهاية col-md-4
    }
    echo '</div>'; // نهاية row
} else {
    echo "لا توجد تقارير.";
}

// إغلاق الاتصال
$conn->close();
?>

            
                
        </div>
    </div>
</div>
    <footer class="footer" style="border-radius: 10px 10px 0 0;">
        <p>حقوق النشر &copy; 2024 معًا. جميع الحقوق محفوظة.</p>
    </footer>

    <button class="chat-button" id="openChat" onclick="toggleChat()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text-fill" viewBox="0 0 16 16">
        <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1m0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1m0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1"/>
      </svg></button>
      <div class="chat-popup" id="chatPopup">
        <div class="chat-header">
            شات بوت
            <button onclick="toggleChat()" style="float: right; background: none; border: none; color: white;">×</button>
        </div>
        <div class="chat-body" id="chatBody">
            <div class="bot-message">مرحبًا! كيف يمكنني مساعدتك؟</div>
        </div>
        <div class="chat-input">
            <input type="text" id="userInput" placeholder="اكتب هنا...">
            <button onclick="sendMessage()">إرسال</button>
        </div>
    </div>
    
    <script>
        function toggleChat() {
            const chatPopup = document.getElementById('chatPopup');
            chatPopup.style.display = chatPopup.style.display === 'block' ? 'none' : 'block';
        }
    
        function sendMessage() {
            const input = document.getElementById('userInput');
            const userMessage = input.value;
            if (userMessage) {
                const chatBody = document.getElementById('chatBody');
                chatBody.innerHTML += `<div class="user-message"><strong>أنت:</strong> ${userMessage}</div>`;
                input.value = '';
    
                // الردود
                const response = getResponse(userMessage);
                chatBody.innerHTML += `<div class="bot-message"><strong>البوت:</strong> ${response}</div>`;
                chatBody.scrollTop = chatBody.scrollHeight; // للتمرير لأسفل
            }
        }
    
        function getResponse(message) {
            message = message.toLowerCase();
            if (message.includes('مرحبا') || message.includes('كيف حالك')) {
                return 'مرحبًا! أنا هنا للمساعدة.';
            } else if (message.includes('بلاغ') || message.includes('سيارة مسروقة')) {
                return 'يمكنك رفع بلاغ عن السيارة المفقودة عبر نموذج البلاغ.';
            } else if (message.includes('كيف يمكنني رفع بلاغ')) {
                return 'يمكنك ملء نموذج البلاغ المتاح على الموقع.';
            } else if (message.includes('ما هو موقع رفع البلاغات')) {
                return 'موقع يتيح للمستخدمين تقديم بلاغات عن السيارات المسروقة أو المفقودة.';
            } else if (message.includes('هل يجب علي تسجيل حساب')) {
                return 'لا، يمكنك رفع البلاغ بدون حساب، لكن يفضل تسجيل حساب لمتابعة البلاغات.';
            } else if (message.includes('كيف يمكنني متابعة حالة البلاغ')) {
                return 'يمكنك متابعة حالة البلاغ من خلال حسابك على الموقع.';
            } else if (message.includes('هل يمكنني تعديل البلاغ')) {
                return 'نعم، يمكنك تعديل البلاغ قبل أن يتم التعامل معه.';
            } else if (message.includes('إلى من يتم إرسال البلاغات')) {
                return 'يتم إرسال البلاغات إلى الجهات المختصة مثل الشرطة.';
            } else if (message.includes('ماذا أفعل إذا وجدت سيارة مسروقة')) {
                return 'يجب عليك الاتصال بالجهات المختصة أو الشرطة للإبلاغ.';
            } else if (message.includes('هل هناك أي رسوم')) {
                return 'لا، رفع البلاغات عبر الموقع مجاني.';
            } else {
                return 'عذرًا، لم أفهم سؤالك. يمكنك طرح سؤال آخر!';
            }
        }
    </script>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
   
</body>
</html>
                <button class="btn btn-custom" style="background-color: #1A4500; color: white;" data-toggle="modal" data-target="#registerModal">تسجيل جديد</button>
                <!-- بوب اب تسجيل جديد -->
                <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="registerModalLabel">تسجيل جديد</h5>
                             
                            </div>
                            <div class="modal-body">
                                <form id="registerForm" method="POST">
                                    <div class="form-group">
                                        <label for="name">الاسم</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">البريد الإلكتروني</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">رقم الجوال</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">كلمة المرور</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm-password">تأكيد كلمة المرور</label>
                                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="agree" name="agree" required>
                                        <label class="form-check-label" for="agree">أوافق على الشروط</label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                <button type="submit" name="submit" class="btn btn-primary">تسجيل</button>
                                
                            </form>
                         

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
	</header>
	<?php
                            // إعداد الاتصال بقاعدة البيانات
                            $servername = "localhost"; // أو عنوان السيرفر الخاص بك
                            $username = "root"; // اسم المستخدم لقاعدة البيانات
                            $password = ""; // كلمة سر قاعدة البيانات فارغة
                            $dbname = "mean_r"; // اسم قاعدة البيانات
                            
                            // إنشاء الاتصال
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            
                            // التحقق من الاتصال
                            if ($conn->connect_error) {
                                die("فشل الاتصال: " . $conn->connect_error);
                            }
                            
                            // التحقق من وجود بيانات POST
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                                // الحصول على البيانات من النموذج
                                $name = $conn->real_escape_string($_POST['name']);
                                $email = $conn->real_escape_string($_POST['email']);
                                $phone = $conn->real_escape_string($_POST['phone']);
                                $password = $conn->real_escape_string($_POST['password']);
                                $confirm_password = $conn->real_escape_string($_POST['confirm-password']);
                            
                                // التحقق من أن جميع الحقول قد تم ملؤها
                                if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
                                    die("يرجى ملء جميع الحقول.");
                                }
                            
                                // التحقق من أن كلمة المرور وتأكيد كلمة المرور متطابقتان
                                if ($password !== $confirm_password) {
                                    die("كلمة المرور وتأكيد كلمة المرور لا يتطابقان.");
                                }
                            
                                // التحقق من أن البريد الإلكتروني المدخل صالح
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    echo '<script>
window.alert(البريد الإلكتروني المدخل غير صالح.);
</script>'; 
								  
								  
                                }
                            
                                // التحقق من عدم تكرار البريد الإلكتروني ورقم الهاتف
                                $checkEmail = "SELECT * FROM users WHERE email='$email'";
                                $resultEmail = $conn->query($checkEmail);
                            
                                if ($resultEmail->num_rows > 0) {
                                                                echo '<script>
window.alert(البريد الإلكتروني مستخدم بالفعل.);
</script>'; 
								  
                                }
                            
                                $checkPhone = "SELECT * FROM users WHERE phone='$phone'";
                                $resultPhone = $conn->query($checkPhone);
                            
                                if ($resultPhone->num_rows > 0) {
                                    echo '<script>
window.alert(رقم الهاتف مستخدم بالفعل.);
</script>';
								   
                                }
                            
                                // تشفير كلمة المرور
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            
                                // إدخال البيانات في قاعدة البيانات
                                $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashed_password')";
                            
                                if ($conn->query($sql) === TRUE) {
                                   echo '<script>
window.alert(تم تسجيل البيانات بنجاح.);
</script>';
								   
                                } else {
                                    echo "خطأ: " . $sql . "<br>" . $conn->error;
                                }
                            }
                            
                            // إغلاق الاتصال
                            $conn->close();
                            ?>
   

    <div class="container mt-5 ">
        <div class="content-box"  style="background-color: #D9D9D9;">
            <div class="text-section">
                <h1 style="font-weight: bolder; font-size: 50px;">يدا بيد معًا لعونك</h1>
                <p>لديك سيارة مفقودة؟ لا تتردد، أبلغنا وسنكون هنا لمساعدتك!</p>
                <button class="btn btn-primary" style="border-radius: 10px; background-color: #1A4500; border: none;" data-toggle="modal" data-target="#reportModal" disabled>إنشاء بلاغ</button>
            </div>
            <img src="_2c86ea53-ad11-431a-aec9-6d8e8d2.png" alt="صورة" class="img-fluid mr-31" style="margin-right: auto ;">
        </div>
<!-- بوب اب إنشاء بلاغ -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">إنشاء بلاغ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="carImage">صورة السيارة</label>
                        <input type="file" class="form-control" id="carImage" required>
                    </div>
                    <div class="form-group">
                        <label for="carType">نوع السيارة</label>
                        <input type="text" class="form-control" id="carType" required>
                    </div>
                    <div class="form-group">
                        <label for="carPlate">لوحة السيارة</label>
                        <input type="text" class="form-control" id="carPlate" required>
                    </div>
                    <div class="form-group">
                        <label for="carColor">لون السيارة</label>
                        <input type="text" class="form-control" id="carColor" required>
                    </div>
                    <div class="form-group">
                        <label for="location">المكان</label>
                        <input type="text" class="form-control" id="location" required>
                    </div>
                    <div class="form-group">
                        <label for="reward">هل يوجد مكافأة؟</label>
                        <select class="form-control" id="reward" required>
                            <option value="نعم">نعم</option>
                            <option value="لا">لا</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary">إرسال البلاغ</button>
            </div>
        </div>
    </div>
</div>

        <div class="scrollable-section">
            <div class="row" id="card-container">
 



              
              <?php
// إعداد الاتصال بقاعدة البيانات
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "mean_r"; 


// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");
// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// استعلام لجلب البيانات
$sql = "SELECT * FROM reports";
$result = $conn->query($sql);

// التحقق مما إذا كانت هناك نتائج
if ($result->num_rows > 0) {
    echo '<div class="row">'; // بدء صف Bootstrap
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card mx-auto">';
        echo '<img src="' . $row['car_image'] . '" class="card-img-top" alt="صورة السيارة">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($row['car_type']) . '</h5>';
        echo 'الموقع: ' . htmlspecialchars($row['location']) . '<br>';
        echo 'المكافأة: ' . htmlspecialchars($row['reward']) . '<br>';
        echo 'تاريخ الإنشاء: ' . htmlspecialchars($row['created_at']) . '</p>';
        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contentModal" disabled>عرض</button>';
        echo '</div>'; // نهاية card-body
        echo '</div>'; // نهاية card
        echo '</div>'; // نهاية col-md-4
    }
    echo '</div>'; // نهاية row
} else {
    echo "لا توجد تقارير.";
}

// إغلاق الاتصال
$conn->close();
?>

            
                
        </div>
    </div>
</div>
    <footer class="footer" style="border-radius: 10px 10px 0 0;">
        <p>حقوق النشر &copy; 2024 معًا. جميع الحقوق محفوظة.</p>
    </footer>

    <button class="chat-button" id="openChat" onclick="toggleChat()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text-fill" viewBox="0 0 16 16">
        <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1m0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1m0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1"/>
      </svg></button>
      <div class="chat-popup" id="chatPopup">
        <div class="chat-header">
            شات بوت
            <button onclick="toggleChat()" style="float: right; background: none; border: none; color: white;">×</button>
        </div>
        <div class="chat-body" id="chatBody">
            <div class="bot-message">مرحبًا! كيف يمكنني مساعدتك؟</div>
        </div>
        <div class="chat-input">
            <input type="text" id="userInput" placeholder="اكتب هنا...">
            <button onclick="sendMessage()">إرسال</button>
        </div>
    </div>
    
    <script>
        function toggleChat() {
            const chatPopup = document.getElementById('chatPopup');
            chatPopup.style.display = chatPopup.style.display === 'block' ? 'none' : 'block';
        }
    
        function sendMessage() {
            const input = document.getElementById('userInput');
            const userMessage = input.value;
            if (userMessage) {
                const chatBody = document.getElementById('chatBody');
                chatBody.innerHTML += `<div class="user-message"><strong>أنت:</strong> ${userMessage}</div>`;
                input.value = '';
    
                // الردود
                const response = getResponse(userMessage);
                chatBody.innerHTML += `<div class="bot-message"><strong>البوت:</strong> ${response}</div>`;
                chatBody.scrollTop = chatBody.scrollHeight; // للتمرير لأسفل
            }
        }
    
        function getResponse(message) {
            message = message.toLowerCase();
            if (message.includes('مرحبا') || message.includes('كيف حالك')) {
                return 'مرحبًا! أنا هنا للمساعدة.';
            } else if (message.includes('بلاغ') || message.includes('سيارة مسروقة')) {
                return 'يمكنك رفع بلاغ عن السيارة المفقودة عبر نموذج البلاغ.';
            } else if (message.includes('كيف يمكنني رفع بلاغ')) {
                return 'يمكنك ملء نموذج البلاغ المتاح على الموقع.';
            } else if (message.includes('ما هو موقع رفع البلاغات')) {
                return 'موقع يتيح للمستخدمين تقديم بلاغات عن السيارات المسروقة أو المفقودة.';
            } else if (message.includes('هل يجب علي تسجيل حساب')) {
                return 'لا، يمكنك رفع البلاغ بدون حساب، لكن يفضل تسجيل حساب لمتابعة البلاغات.';
            } else if (message.includes('كيف يمكنني متابعة حالة البلاغ')) {
                return 'يمكنك متابعة حالة البلاغ من خلال حسابك على الموقع.';
            } else if (message.includes('هل يمكنني تعديل البلاغ')) {
                return 'نعم، يمكنك تعديل البلاغ قبل أن يتم التعامل معه.';
            } else if (message.includes('إلى من يتم إرسال البلاغات')) {
                return 'يتم إرسال البلاغات إلى الجهات المختصة مثل الشرطة.';
            } else if (message.includes('ماذا أفعل إذا وجدت سيارة مسروقة')) {
                return 'يجب عليك الاتصال بالجهات المختصة أو الشرطة للإبلاغ.';
            } else if (message.includes('هل هناك أي رسوم')) {
                return 'لا، رفع البلاغات عبر الموقع مجاني.';
            } else {
                return 'عذرًا، لم أفهم سؤالك. يمكنك طرح سؤال آخر!';
            }
        }
    </script>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
   
</body>
</html>