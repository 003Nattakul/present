<!DOCTYPE html>
<html lang="en">
<?php
//เชื่อมต่อฐานข้อมูล
include("conn.php");
include("clogin.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลอาจารย์</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Kanit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #34495e;
        }
        
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-bottom: 60px;
        }
        
        .navbar {
            background-color: var(--secondary-color);
            color: white;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-weight: 500;
            font-size: 1.2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
        }
        
        .page-title {
            color: var(--secondary-color);
            font-weight: 600;
            margin: 30px 0;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }
        
        .page-title:after {
            content: '';
            position: absolute;
            width: 100px;
            height: 3px;
            background: var(--primary-color);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            padding: 15px 20px;
            border: none;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            border-color: var(--primary-color);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--secondary-color);
        }
        
        .btn {
            border-radius: 8px;
            padding: 8px 25px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
            transform: translateY(-2px);
        }
        
        .alert {
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            border: none;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid var(--success-color);
        }
        
        .footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 0.9rem;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        
        .icon-text {
            margin-right: 8px;
        }
        
        .container {
            max-width: 900px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand">
                <i class="fas fa-chalkboard-teacher icon-text"></i>
                ระบบจัดการข้อมูลครู
            </span>
        </div>
    </nav>
    
    <div class="container">
        <h1 class="page-title">แก้ไขข้อมูลอาจารย์</h1>
        
        <?php
        //เริ่มเก็บข้อมูล
        $teacher_id = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : '';
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $age = isset($_POST['age']) ? $_POST['age'] : '';
        $salary = isset($_POST['salary']) ? $_POST['salary'] : '';

        //เขียนคำสั่ง SQL
        $sql = "UPDATE teachers SET first_name='$first_name', last_name='$last_name', subject='$subject', gender='$gender', age='$age', salary='$salary' WHERE teacher_id=$teacher_id";

        // รับคำสั่ง sql
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success">
                <i class="fas fa-check-circle icon-text"></i>
                ยินดีด้วยครับ! คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว
            </div>';
            
            echo '<div class="text-center mt-4">
                <a href="show.php" class="btn btn-primary">
                    <i class="fas fa-list icon-text"></i>
                    กลับหน้าแสดงข้อมูล
                </a>
            </div>';
        } else {
            echo '<div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle icon-text"></i>
                มีข้อผิดพลาด: ' . $sql . '<br>' . $conn->error . '
            </div>';
        }
        
        // ปิดการเชื่อมต่อ
        $conn->close();
        ?>
        
        <div class="card mt-5">
            <div class="card-header">
                <i class="fas fa-info-circle icon-text"></i>
                เกี่ยวกับระบบ
            </div>
            <div class="card-body">
                <p>ระบบนี้ใช้สำหรับการจัดการข้อมูลอาจารย์ภายในสถาบันการศึกษา ช่วยให้สามารถเพิ่ม แก้ไข และลบข้อมูลอาจารย์ได้อย่างสะดวกและรวดเร็ว</p>
                <p>หากมีข้อสงสัยหรือพบปัญหาการใช้งาน กรุณาติดต่อผู้ดูแลระบบ</p>
            </div>
        </div>
    </div>
    
    <footer class="footer">
        <div class="container">
            <i class="fas fa-code icon-text"></i>
            พัฒนาโดย 653485003 นายณัฐกุล จิระศิริโชติ
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>