<?php
require"student_management.php";
$students=getAllStudents();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
</head>
<body>
    <?php 
    $data = $error =array();
    if(isset($_POST["submit_add"]))
    {
        //lấy thông tin
        $data["student_id"]=!empty($_POST["id"]) ? $_POST["id"] : "";
        $data["student_name"]=!empty($_POST["name"]) ? $_POST["name"] : "";
        $data["student_email"]=!empty($_POST["email"]) ? $_POST["email"] : "";
        //validate
        if(empty($data["student_id"]))
        {
            $error["student_id"]="Bạn chưa nhập id sinh viên";
        }
        if(empty($data["student_name"]))
        {
            $error["student_name"]="Bạn chưa nhập tên sinh viên";
        }
        if(empty($data["student_email"]))
        {
            $error["student_email"]="Bạn chưa nhập email";
        }
        else{
            $result=filter_var($data["student_email"],FILTER_VALIDATE_EMAIL);
            $result_validate_email=$result ? "":"Email của bạn không hợp lệ";
        }

        //nếu dữ liệu hợp lệ thì thực hiện thao tác add student và chuyển về file index.php
        if(empty($error) && empty($result_validate_email))
        {
            //kiểm tra ID người dùng nhập đã tồn tại trong danh sách hay chưa
           $check = addStudent($data["student_id"],$data["student_name"],$data["student_email"]);
           if($check==false)
           {
               $flag="ID bạn nhập đã tồn tại";
           }
           else
           {
            addStudent($data["student_id"],$data["student_name"],$data["student_email"]);
            header("location:index.php");
           }
        }
    }
    ?>
    <a href="index.php">BACK</a>
    <form action="" method="post">
    <table  border="1px" cellspacing="0" cellpadding="10">
        <caption><h2>THÊM SINH VIÊN</h2></caption>
        <tr>
            <th>Nhập ID:</th>
            <td><input type="text" name="id" value="<?php echo !empty($data['student_id']) ? $data['student_id'] : ''; ?>" />
                        <?php echo !empty($error['student_id']) ? $error['student_id'] : ''; ?>
                        <?php echo !empty($flag) ? $flag : ''; ?></td>
        </tr>
        <tr>   
                <th>Nhập tên:</th>
                <td><input type="text" name="name" value="<?php echo !empty($data['student_name']) ? $data['student_name'] : ''; ?>" />
                        <?php echo !empty($error['student_name']) ? $error['student_name'] : ''; ?></td>
        </tr>
        <tr>
            <th>Nhập email:</th>
            <td><input type="text" name="email" value="<?php echo !empty($data['student_email']) ? $data['student_email'] : ''; ?>" />
                        <?php echo !empty($error['student_email']) ? $error['student_email'] : ''; ?>
                        <?php echo !empty($result_validate_email) ? $result_validate_email : ''; ?></td>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" value="ADD" name="submit_add"></th>
        </tr>
    </table>
</form>
</body>
</html>