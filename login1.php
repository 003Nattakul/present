<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- เพิ่ม ส่วน Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- เพิ่มฟอนต์ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Kanit", sans-serif;
            margin-left: 100px;
            margin-top: 50px;
        }

        h1 {
            /* อันนี้กำหนดส่วนย่อหน้าด้านซ้าย */
            margin-left: 10px;
            /* อันนี้กำหนดส่วนย่อหน้าด้านบน */
            margin-top: 50px;
        }
    </style>
    

    <title>login</title>
</head>
<h1><Center>เข้าสู่ระบบ กรุณากรอกชื่อผู้ใช้และรหัสผ่าน</Center></h1>
<form action="chklogin.php" method="POST">
    <div class="row mb-3">
        <label class="col-sm-1 col-form-label"> ชื่อผู้ใช้ </label>
        <div class="col-sm-2">
            <input type="text" name="u_id" class="form-control" maxlength="30" required>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-1 col-form-label"> รหัสผ่าน </label>
        <div class="col-sm-2">
            <input type="password" name="u_passwd" class="form-control" maxlength="30" required>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary"> เข้าสู่ระบบ</button>
    <button type="reset" class="btn btn-danger"> ยกเลิก</button>
</form>
<br>
    พัฒนาโดย 653485003 นายณัฐกุล จิระศิริโชติ หมู่เรียน 26.16 <br>
</head>

</html>