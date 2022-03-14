<?php 
session_start();
//lấy tất cả danh sách
function getAllStudents(){
    return isset($_SESSION["students"]) ? $_SESSION["students"] : array();
}

//lấy chi tiết thông tin 1 sinh viên theo mã ID
function searchStudent($student_id)
{

    //lấy danh sách sinh viên để tìm
    $students=getAllStudents();
    //Duyệt qua từng phần tử trùng mã id là đã tìm được
    foreach ($students as $key => $item)
     {

        if($item["student_id"]==$student_id)
        {
            return $item;
        }
    }

    //Nếu không tìm được thì return về mảng trống
    return array();
}

//xóa sinh viên bởi mã ID
function deleteStudent($student_id)
{
    // Lấy danh sách sinh viên để tìm
    $students = getAllStudents();
     
    /// Duyệt qua từng phần tử, nếu xuất hiện ID giống nhau thì tức là đã tìm thấy sinh viên
    foreach ($students as $key => $item)
    {
        // Đã tìm thấy thì dùng hàm unset để xóa
        if ($item['student_id'] == $student_id){
            unset($students[$key]);
        }
    }
     
    // Cập nhật lại Session
    $_SESSION['students'] = $students;
     
    return $students;
}
 

function addStudent($student_id,$student_name,$student_email)
{
    //Lấy danh sách sinh viên
    $students=getAllStudents();
    //khởi tạo mảng để lưu chữ dữ liệu để thêm mới sinh viên
    $new_student=array(
        "student_id"=>$student_id,
        "student_name"=>$student_name,
        "student_email"=>$student_email
    );
    //kiểm tra đã có id trước đó trùng hay chưa
    $flag=true;
    foreach ($students as $key => $item) {
        if($item["student_id"]==$new_student["student_id"])
        {
            return $flag =false;
        }
    }
    //Cập nhật lại session
    if($flag)
    {
    $students[]=$new_student;
    $_SESSION["students"]=$students;
    return $students;
    }
}
function updateStudent($student_id,$student_name,$student_email)
{
    //lấy danh sách sinh viên
    $students=getAllStudents();
    //khởi tạo mảng để lưu trữ dữ liệu người dùng muôns thay đổi
    $update_student=array(
        "student_id"=>$student_id,
        "student_name"=>$student_name,
        "student_email"=>$student_email
    );
    //gán giá trị mới cho student muốn update
    $flag=false;
    foreach ($students as $key => $item) 
    {
        if($item["student_id"]==$update_student["student_id"])
        {
            //Lỗi không thể thay đổi được giá trị, mục đích ban đầu:muốn giữ nguyên id,lí do lỗi: chưa tìm ra.
            // $item["student_name"]=$update_student["student_name"];
            // $item["student_email"]=$update_student["student_email"];
            $students[$key]=$update_student;
            $flag =true;
        }
    }
    //cập nhật lại session
    if($flag)
    {
    $_SESSION["students"]=$students;
    }
    return $flag;
}
?>