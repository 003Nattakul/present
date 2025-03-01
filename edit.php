<?php
session_start();

// ตรวจสอบ session ก่อนแสดงผล HTML
if (!isset($_SESSION['u_id']) || empty($_SESSION['u_id']) || !isset($_SESSION['u_name']) || empty($_SESSION['u_name'])) {
    header('Location: login1.php?error=session_expired');
    exit(); // ป้องกันการทำงานของโค้ดถัดไป
}

// โค้ดเดิมจาก edit.php ที่คุณอัปโหลด
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลอาจารย์ | ระบบจัดการข้อมูลครู</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f6f8fb;
            padding-bottom: 80px; /* For footer space */
        }
        .navbar {
            background: linear-gradient(135deg, #0d6efd, #0099ff);
            color: white;
            padding: 18px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            margin-bottom: 30px;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
        }
        .card-header {
            background: linear-gradient(135deg, #0d6efd, #0099ff);
            color: white;
            font-weight: 500;
            padding: 18px 20px;
            border: none;
            position: relative;
            overflow: hidden;
        }
        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(50%, -50%);
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .btn {
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s;
            padding: 10px 20px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0099ff);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7, #0077cc);
            transform: translateY(-2px);
        }
        .btn-danger:hover {
            transform: translateY(-2px);
        }
        .developer-credit {
            margin-top: 30px;
            color: #6c757d;
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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
            z-index: 1000;
        }
        .page-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }
        .page-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background: #0d6efd;
            border-radius: 2px;
        }
        .form-section {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        }
        .info-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php
    // Include database connection and login check
    include("conn.php");
    include("clogin.php");
    
    // Security check for teacher_id
    if (isset($_GET['action_even']) && $_GET['action_even'] == 'edit' && isset($_GET['teacher_id'])) {
        // Use prepared statement for security
        $teacher_id = intval($_GET['teacher_id']); // Force integer conversion
        $stmt = $conn->prepare("SELECT * FROM teachers WHERE teacher_id = ?");
        $stmt->bind_param("i", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<script>
                  window.location.href = 'show.php';
                  alert('ไม่พบข้อมูลที่ต้องการแก้ไข กรุณาตรวจสอบ');
                  </script>";
            exit();
        }
        $stmt->close();
    } else {
        // Redirect if not proper access
        header("Location: show.php");
        exit();
    }
    ?>

    <!-- Navbar -->
    <div class="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="fs-4 fw-bold">
                <i class="fas fa-chalkboard-teacher me-2"></i>
                ระบบจัดการข้อมูลครู
            </div>
            <div>
                <a href="show.php" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left me-1"></i> กลับไปยังหน้าแสดงข้อมูล
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h2 class="page-title"><i class="fas fa-user-edit me-2"></i>แก้ไขข้อมูลอาจารย์</h2>
                
                <div class="form-section">
                    <form action="edit_1.php" method="POST" id="editTeacherForm">
                        <input type="hidden" name="teacher_id" value="<?php echo $row['teacher_id']; ?>">
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">รหัสประจำตัวอาจารย์</label>
                                    <input type="text" class="form-control bg-light" value="<?php echo $row['teacher_id']; ?>" disabled>
                                    <div class="info-text">รหัสประจำตัวไม่สามารถแก้ไขได้</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อ <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" class="form-control" maxlength="50" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">นามสกุล <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" class="form-control" maxlength="50" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">วิชา <span class="text-danger">*</span></label>
                                    <select name="subject" id="subject" class="form-select" required>
                                        <option value="คณิตศาสตร์" <?php echo ($row['subject'] == 'คณิตศาสตร์') ? 'selected' : ''; ?>>คณิตศาสตร์</option>
                                        <option value="วิทยาศาสตร์" <?php echo ($row['subject'] == 'วิทยาศาสตร์') ? 'selected' : ''; ?>>วิทยาศาสตร์</option>
                                        <option value="ภาษาไทย" <?php echo ($row['subject'] == 'ภาษาไทย') ? 'selected' : ''; ?>>ภาษาไทย</option>
                                        <option value="ภาษาอังกฤษ" <?php echo ($row['subject'] == 'ภาษาอังกฤษ') ? 'selected' : ''; ?>>ภาษาอังกฤษ</option>
                                        <option value="สังคมศึกษา" <?php echo ($row['subject'] == 'สังคมศึกษา') ? 'selected' : ''; ?>>สังคมศึกษา</option>
                                        <option value="ศิลปะ" <?php echo ($row['subject'] == 'ศิลปะ') ? 'selected' : ''; ?>>ศิลปะ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">เพศ <span class="text-danger">*</span></label>
                                    <select name="gender" id="gender" class="form-select" required>
                                        <option value="ชาย" <?php echo ($row['gender'] == 'ชาย') ? 'selected' : ''; ?>>ชาย</option>
                                        <option value="หญิง" <?php echo ($row['gender'] == 'หญิง') ? 'selected' : ''; ?>>หญิง</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">อายุ <span class="text-danger">*</span></label>
                                    <input type="number" name="age" id="age" value="<?php echo $row['age']; ?>" class="form-control" min="18" max="100" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">เงินเดือน (บาท) <span class="text-danger">*</span></label>
                                    <input type="number" name="salary" id="salary" value="<?php echo $row['salary']; ?>" class="form-control" min="15000" step="0.01" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> บันทึกข้อมูล
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fas fa-times me-2"></i> ยกเลิก
                            </button>
                            <a href="show.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> กลับ
                            </a>
                        </div>
                    </form>
                </div>
                
                <!-- Developer Credit -->
                <div class="developer-credit mt-4">
                    <p class="mb-0">
                        <i class="fas fa-code me-2"></i> พัฒนาโดย 653485003 นายณัฐกุล จิระศิริโชติ | หมู่เรียน 26.16
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-0">© 2025 ระบบจัดการข้อมูลครู | มหาวิทยาลัยราชภัฏนครราชสีมา</p>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    
    <!-- Form Validation Script -->
    <script>
        $(document).ready(function() {
            // Form submission with validation
            $('#editTeacherForm').on('submit', function(e) {
                // Check first name and last name
                const firstName = $('#first_name').val().trim();
                const lastName = $('#last_name').val().trim();
                if (firstName === '' || lastName === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อมูลไม่ครบถ้วน',
                        text: 'กรุณากรอกชื่อและนามสกุลให้ครบถ้วน',
                        confirmButtonText: 'ตกลง'
                    });
                    return false;
                }
                
                // Check age
                const age = parseInt($('#age').val());
                if (isNaN(age) || age < 18 || age > 100) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'อายุไม่ถูกต้อง',
                        text: 'กรุณากรอกอายุระหว่าง 18-100 ปี',
                        confirmButtonText: 'ตกลง'
                    });
                    return false;
                }
                
                // Check salary
                const salary = parseFloat($('#salary').val());
                if (isNaN(salary) || salary < 15000) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'เงินเดือนไม่ถูกต้อง',
                        text: 'เงินเดือนต้องไม่น้อยกว่า 15,000 บาท',
                        confirmButtonText: 'ตกลง'
                    });
                    return false;
                }
                
                // Confirm submission
                e.preventDefault();
                Swal.fire({
                    title: 'ยืนยันการแก้ไขข้อมูล',
                    text: "คุณต้องการบันทึกการเปลี่ยนแปลงข้อมูลใช่หรือไม่?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'ใช่, บันทึกข้อมูล',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>