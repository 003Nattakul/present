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
            margin-left: 50px;
            margin-top: 50px;
        }

        h1 {
            /* อันนี้กำหนดส่วนย่อหน้าด้านซ้าย */
            margin-left: 50px;
            /* อันนี้กำหนดส่วนย่อหน้าด้านบน */
            margin-top: 50px;
        }
    </style>


    <title>เเก้ไขข้อมูลอาจารย์</title>
</head>

<?php
if (isset($_GET['action_even']) == 'edit') {
    $teacher_id = $_GET['teacher_id'];
    $sql = "SELECT * FROM teachers WHERE teacher_id=$teacher_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูลที่ต้องการแก้ไข กรุณาตรวจสอบ";
    }
    //$conn->close();
}
?>

<h1>แก้ไขข้อมูลอาจารย์</h1>


<form action="edit_1.php" method="POST">
    <input type="hidden" name="teacher_id" value="<?php echo $row['teacher_id']; ?>">
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"> รหัสประจำตัวอาจารย์ </label>
        <div class="col-sm-3">
            <label class="col-sm-2 col-form-label"> <?php echo $row['teacher_id']; ?> </label>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"> ชื่อ </label>
        <div class="col-sm-3">
            <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" class="form-control" maxlength="50" required>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"> นามสกุล </label>
        <div class="col-sm-3">
            <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" class="form-control" maxlength="50" required>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"> วิชา </label>
        <div class="col-sm-3">
            <select name="subject" class="form-select" aria-label="Default select example">
                <option value="คณิตศาสตร์" <?php if ($row['subject'] == 'คณิตศาสตร์') {
                                                echo "selected";
                                            } ?>>คณิตศาสตร์</option>
                <option value="วิทยาศาสตร์" <?php if ($row['subject'] == 'วิทยาศาสตร์') {
                                                echo "selected";
                                            } ?>>วิทยาศาสตร์</option>
                <option value="ภาษาไทย" <?php if ($row['subject'] == 'ภาษาไทย') {
                                                echo "selected";
                                            } ?>>ภาษาไทย</option>
                <option value="ภาษาอังกฤษ" <?php if ($row['subject'] == 'ภาษาอังกฤษ') {
                                                echo "selected";
                                            } ?>>ภาษาอังกฤษ</option>
                <option value="สังคมศึกษา" <?php if ($row['subject'] == 'สังคมศึกษา') {
                                                echo "selected";
                                            } ?>>สังคมศึกษา</option>
                <option value="ศิลปะ" <?php if ($row['subject'] == 'ศิลปะ') {
                                                echo "selected";
                                            } ?>>ศิลปะ</option>

            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"> เพศ </label>
        <div class="col-sm-3">
            <select name="gender" class="form-select" aria-label="Default select example">
                <option value="ชาย" <?php if ($row['gender'] == 'ชาย') {
                                        echo "selected";
                                    } ?>>ชาย</option>
                <option value="หญิง" <?php if ($row['gender'] == 'หญิง') {
                                            echo "selected";
                                        } ?>>หญิง</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"> อายุ </label>
        <div class="col-sm-3">
            <input type="text" name="age" value="<?php echo $row['age']; ?>" class="form-control" maxlength="3" required>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"> เงินเดือน </label>
        <div class="col-sm-3">
            <input type="text" name="salary" value="<?php echo $row['salary']; ?>" class="form-control" maxlength="10" required>
        </div>
    </div>



    <button type="submit" class="btn btn-primary"> บันทึกข้อมูล</button>
    <button type="reset" class="btn btn-danger"> ยกเลิก</button>

</form>
<br>
พัฒนาโดย 653485003 นายณัฐกุล จิระศิริโชติ <br>
</head>

</html>