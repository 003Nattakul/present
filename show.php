<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการข้อมูลอาจารย์</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f8f9fa;
            padding-top: 20px;
            padding-bottom: 50px;
        }
        
        .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .header-section {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .user-info {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 0 5px 5px 0;
        }
        
        .table-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 30px;
        }
        
        table.dataTable {
            border-collapse: collapse !important;
            width: 100% !important;
        }
        
        .table th {
            background-color: #f1f8ff;
            color: #0056b3;
            font-weight: 500;
        }
        
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 123, 255, 0.05);
        }
        
        .btn-primary {
            background-color: #007bff;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-danger {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .alert {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            margin-top: 30px;
        }
        
        .developer-info {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php
    include("conn.php");
    include("clogin.php");
    ?>
    
    <div class="container">
        <div class="header-section">
            <div class="row">
                <div class="col-md-8">
                    <h1><i class="fas fa-chalkboard-teacher me-2"></i>ระบบจัดการข้อมูลอาจารย์</h1>
                </div>
                <div class="col-md-4 text-end">
                    <a href="login1.php" class="btn btn-light"><i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ</a>
                </div>
            </div>
        </div>
        
        <div class="user-info">
            <div class="row">
                <div class="col-md-8">
                    <h4><i class="fas fa-user-circle me-2"></i>ข้อมูลผู้ใช้งาน</h4>
                    <p>
                        <strong>รหัสผู้ใช้:</strong> <?php echo isset($_SESSION["u_id"]) ? $_SESSION["u_id"] : "ไม่พบข้อมูล"; ?> | 
                        <strong>ชื่อผู้ใช้:</strong> <?php echo isset($_SESSION["u_name"]) ? $_SESSION["u_name"] : "ไม่พบข้อมูล"; ?> | 
                        <strong>แผนก:</strong> <?php echo isset($_SESSION["u_subject"]) ? $_SESSION["u_subject"] : "ไม่พบข้อมูล"; ?>
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="add.php" class="btn btn-success"><i class="fas fa-plus-circle me-2"></i>เพิ่มข้อมูลอาจารย์</a>
                </div>
            </div>
        </div>
        
        <?php
        if (isset($_GET['action_even']) && $_GET['action_even'] == 'del') {
            $teacher_id = $_GET['teacher_id'];
            $sql = "SELECT * FROM teachers WHERE teacher_id=$teacher_id";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $sql = "DELETE FROM teachers WHERE teacher_id=$teacher_id";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'><i class='fas fa-check-circle me-2'></i>ลบข้อมูลสำเร็จ</div>";
                } else {
                    echo "<div class='alert alert-danger'><i class='fas fa-exclamation-triangle me-2'></i>ลบข้อมูลมีข้อผิดพลาด กรุณาตรวจสอบ !!! " . $conn->error . "</div>";
                }
            } else {
                echo "<div class='alert alert-warning'><i class='fas fa-exclamation-circle me-2'></i>ไม่พบข้อมูล กรุณาตรวจสอบ</div>";
            }
        }
        ?>
        
        <div class="table-container">
            <table id="teachers" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th><i class="fas fa-id-card me-2"></i>รหัสประจำตัว</th>
                        <th><i class="fas fa-user me-2"></i>ชื่อ</th>
                        <th><i class="fas fa-user me-2"></i>นามสกุล</th>
                        <th><i class="fas fa-book me-2"></i>วิชา</th>
                        <th><i class="fas fa-venus-mars me-2"></i>เพศ</th>
                        <th><i class="fas fa-birthday-cake me-2"></i>อายุ</th>
                        <th><i class="fas fa-money-bill-wave me-2"></i>เงินเดือน</th>
                        <th><i class="fas fa-cogs me-2"></i>จัดการข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM teachers ORDER BY teacher_id ASC";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["teacher_id"] . "</td>";
                        echo "<td>" . $row["first_name"] . "</td>";
                        echo "<td>" . $row["last_name"] . "</td>";
                        echo "<td>" . $row["subject"] . "</td>";
                        
                        // Format gender display
                        $genderIcon = ($row["gender"] == 'ชาย') ? '<i class="fas fa-male text-primary"></i>' : '<i class="fas fa-female text-danger"></i>';
                        echo "<td>" . $genderIcon . " " . $row["gender"] . "</td>";
                        
                        echo "<td>" . $row["age"] . "</td>";
                        
                        // Format salary with commas
                        $formattedSalary = number_format($row["salary"], 2);
                        echo "<td>" . $formattedSalary . " บาท</td>";
                        
                        echo '<td>
                            <a type="button" href="show.php?action_even=del&teacher_id=' . $row['teacher_id'] . '" 
                               title="ลบข้อมูล" 
                               onclick="return confirm(\'ต้องการจะลบข้อมูลรายชื่อ ' . $row['teacher_id'] . ' ' . $row['first_name'] . ' ' . $row['last_name'] . '?\')" 
                               class="btn btn-danger btn-sm">
                               <i class="fas fa-trash-alt"></i> ลบ
                            </a>
                            <a type="button" href="edit.php?action_even=edit&teacher_id=' . $row['teacher_id'] . '" 
                               title="แก้ไขข้อมูล" 
                               onclick="return confirm(\'ต้องการจะแก้ไขข้อมูลรายชื่อ ' . $row['teacher_id'] . ' ' . $row['first_name'] . ' ' . $row['last_name'] . '?\')" 
                               class="btn btn-primary btn-sm">
                               <i class="fas fa-edit"></i> แก้ไข
                            </a>
                        </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>ไม่พบข้อมูลในระบบ</td></tr>";
                }
                $conn->close();
                ?>
                </tbody>
            </table>
        </div>
        
        <div class="developer-info text-center">
            <p><i class="fas fa-code me-2"></i>พัฒนาโดย 653485003 นายณัฐกุล จิระศิริโชติ หมู่เรียน 26.16</p>
        </div>
        
        <div class="footer">
            © 2025 ระบบจัดการข้อมูลครู - มหาวิทยาลัยราชภัฏนครราชสีมา
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
    $(document).ready(function() {
        $('#teachers').DataTable({
            language: {
                search: "ค้นหา:",
                lengthMenu: "แสดง _MENU_ รายการ",
                info: "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                infoEmpty: "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
                infoFiltered: "(กรองจากทั้งหมด _MAX_ รายการ)",
                paginate: {
                    first: "หน้าแรก",
                    last: "หน้าสุดท้าย",
                    next: "ถัดไป",
                    previous: "ก่อนหน้า"
                }
            },
            responsive: true,
            order: [[0, 'asc']]
        });
    });
    </script>
</body>
</html>