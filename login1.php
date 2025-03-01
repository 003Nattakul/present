<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ | ระบบจัดการข้อมูลครู</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f0f4f8;
            padding-bottom: 60px; /* For footer space */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(135deg, #0d6efd, #0099ff);
            color: white;
            padding: 15px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .login-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            color: #0d6efd;
            font-weight: 600;
        }
        .form-floating {
            margin-bottom: 20px;
        }
        .form-floating input {
            height: 60px;
            border-radius: 10px;
        }
        .form-floating label {
            padding: 1rem 1.25rem;
        }
        .btn {
            border-radius: 10px;
            font-weight: 500;
            padding: 12px 20px;
            transition: all 0.3s;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0099ff);
            border: none;
            width: 100%;
            margin-top: 10px;
            font-size: 18px;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7, #0077cc);
            transform: translateY(-2px);
        }
        .btn-danger {
            width: 100%;
            margin-top: 10px;
            font-size: 18px;
        }
        .btn-danger:hover {
            transform: translateY(-2px);
        }
        .developer-credit {
            margin-top: 20px;
            color: #6c757d;
            text-align: center;
        }
        footer {
            background: linear-gradient(135deg, #0d6efd, #0099ff);
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
            width: 100%;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="container d-flex justify-content-center">
            <div class="fs-4 fw-bold">
                <i class="fas fa-chalkboard-teacher me-2"></i>
                ระบบจัดการข้อมูลครู
            </div>
        </div>
    </div>

    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <i class="fas fa-user-lock fa-3x text-primary mb-3"></i>
                <h2>เข้าสู่ระบบ</h2>
                <p class="text-muted">กรุณากรอกชื่อผู้ใช้และรหัสผ่านเพื่อเข้าสู่ระบบ</p>
            </div>
            
            <form action="chklogin.php" method="POST" class="needs-validation" novalidate>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="u_id" name="u_id" placeholder="ชื่อผู้ใช้" required>
                    <label for="u_id"><i class="fas fa-user me-2"></i>ชื่อผู้ใช้</label>
                    <div class="invalid-feedback">
                        กรุณากรอกชื่อผู้ใช้
                    </div>
                </div>
                
                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="u_passwd" name="u_passwd" placeholder="รหัสผ่าน" required>
                    <label for="u_passwd"><i class="fas fa-lock me-2"></i>รหัสผ่าน</label>
                    <div class="invalid-feedback">
                        กรุณากรอกรหัสผ่าน
                    </div>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ
                    </button>
                    
                    <button type="reset" class="btn btn-danger">
                        <i class="fas fa-times me-2"></i>ยกเลิก
                    </button>
                </div>
            </form>
            
            <!-- Developer Credit -->
            <div class="developer-credit mt-4">
                <small>
                    <i class="fas fa-code me-1"></i> พัฒนาโดย 653485003 นายณัฐกุล จิระศิริโชติ | หมู่เรียน 26.16
                </small>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <small>© 2025 ระบบจัดการข้อมูลครู | มหาวิทยาลัยราชภัฏนครราชสีมา</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Form validation
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>