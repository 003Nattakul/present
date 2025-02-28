<?php
    include("conn.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: "Kanit", serif;
            font-weight: 300;
            font-style: normal;
            margin-left: 100px;
            margin-bottom: 300px;
            margin-top: 80px;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใช้งาน Bootstrap</title>
</head>
<body>
    <h1>เพิ่มข้อมูลอาจารย์</h1>
    พัฒนาโดย 653485003 นายณัฐกุล จิระศิริโชติ <br>
    หมู่เรียน 26.16 <br>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="row mb-2">
            <label for="inputEmail3" class="col-sm-1 col-form-label">รหัสประจำตัวอาจารย์</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" id="inputEmail3" name="teacher_id">
            </div>

        </div>
        <div class="row mb-2">
            <label for="inputPassword3" class="col-sm-1 col-form-label">ชื่อ</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inputPassword3" name="first_name">
            </div>
        </div>
        <div class="row mb-2">
            <label for="inputPassword3" class="col-sm-1 col-form-label">นามสกุล</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inputPassword3" name="last_name"> 
            </div>
        </div>
        <div class="row mb-2">
            <label for="inputPassword3" class="col-sm-1 col-form-label">วิชา</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inputPassword3" name="subject">
            </div>
        </div>
        <div class="row mb-2">
            <label for="inputPassword3" class="col-sm-1 col-form-label">เพศ</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inputPassword3" name="gender">
            </div>
        </div>
        <div class="row mb-2">
            <label for="inputPassword3" class="col-sm-1 col-form-label">อายุ</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inputPassword3" name="age">
            </div>
        </div>
        <div class="row mb-2">
            <label for="inputPassword3" class="col-sm-1 col-form-label">เงินเดือน</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inputPassword3" name="salary">
            </div>
        </div>


        <button type="submit" class="btn btn-primary">บันทึกข้อมูล </button>
        <button type="reset" class="btn btn-danger">ยกเลิก </button>

    </form> 

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $teacher_id = $_POST['teacher_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $subject = $_POST['subject'] ;
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $salary = $_POST['salary'];

        //    ทำการเพิ่มข้อมูล
        $sql = "INSERT INTO teachers (teacher_id, first_name, last_name, subject, gender, age, salary)
        VALUES ('$teacher_id', '$first_name', '$last_name', '$subject', '$gender', '$age', '$salary')";
        
        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    ?>

    <a type="button" href="show.php" class="btn btn-warning btn-sm"> ไปหน้าแสดงข้อมูล </a>
    
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
