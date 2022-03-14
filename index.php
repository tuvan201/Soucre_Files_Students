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
    <title>Danh sách sinh viên</title>
</head>
<body>
    <a href="student_add.php">THÊM</a>
    <table border="1px" cellspacing="0px" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>FullName</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php 
    foreach ($students as $key => $item) {?>
        <tr>
            <td><?php echo $item["student_id"]?></td>
            <td><a href="student_update.php?id=<?php echo $item["student_id"]; ?>"><?php echo $item["student_name"]?></a></td>
            <td><?php echo $item["student_email"]?></td>
            <td><form action="student_delete.php" method="post">
                <input type="hidden" name="student_id" value="<?php echo $item["student_id"]; ?>">
                <input type="submit" value="Delete">
            </form></td>
        </tr>
   <?php } ?>
    </table>
</body>
</html>