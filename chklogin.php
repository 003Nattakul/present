<?php
    include("conn.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบการเข้าสู่ระบบ | ระบบจัดการข้อมูลครู</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f6f8fb;
            font-family: 'Kanit', sans-serif;
            padding-bottom: 80px;
        }
        .login-container {
            max-width: 450px;
            margin: 100px auto;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(135deg, #0d6efd, #0099ff);
            color: white;
            font-weight: 500;
            padding: 18px 20px;
            border: none;
            text-align: center;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0099ff);
            border: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s;
            padding: 10px 16px;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7, #0077cc);
            transform: translateY(-2px);
        }
        footer {
            background: linear-gradient(135deg, #0d6efd, #0099ff);
            color: white;
            text-align: center;
            padding: 18px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
        }
        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .error-message {
            background-color: #f8d7da;
            color: #842029;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <?php
            // Check if form was submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get form data and sanitize inputs
                $u_id = filter_input(INPUT_POST, 'u_id', FILTER_SANITIZE_STRING);
                $u_passwd = $_POST['u_passwd']; // Don't sanitize password before verification
                
                if (empty($u_id) || empty($u_passwd)) {
                    echo '<div class="alert alert-danger">กรุณากรอกข้อมูลให้ครบถ้วน</div>';
                } else {
                    // Use prepared statement to prevent SQL injection
                    $stmt = $conn->prepare("SELECT * FROM userdata WHERE u_id = ?");
                    $stmt->bind_param("s", $u_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        
                        // In a real application, you should use password_verify() here
                        // This is just for compatibility with your current setup
                        if ($row['u_passwd'] === $u_passwd) {
                            $_SESSION["u_id"] = $u_id;
                            $_SESSION["u_name"] = $row['u_name'];
                            $_SESSION["u_subject"] = $row['u_subject'];
                            
                            // Redirect to main page
                            header("Location: show.php");
                            exit();
                        } else {
                            echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>ไม่พบชื่อผู้ใช้นี้ในระบบ กรุณาตรวจสอบชื่อผู้ใช้</div>';
                    }
                    
                    $stmt->close();
                }
            }
            ?>
            
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-user-lock me-2"></i>ตรวจสอบการเข้าสู่ระบบ</h4>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <p>กรุณารอสักครู่ ระบบกำลังตรวจสอบข้อมูลการเข้าสู่ระบบ...</p>
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="login1.php" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>กลับไปยังหน้าเข้าสู่ระบบ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p class="mb-0">© 2025 ระบบจัดการข้อมูลครู | มหาวิทยาลัยราชภัฏนครราชสีมา</p>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto redirect if no response after 3 seconds
        setTimeout(function() {
            document.querySelector('.login-container').innerHTML = `
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล กรุณาลองใหม่อีกครั้ง
                </div>
                <div class="text-center">
                    <a href="login1.php" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>กลับไปยังหน้าเข้าสู่ระบบ
                    </a>
                </div>
            `;
        }, 10000);
    </script>
</body>
</html>