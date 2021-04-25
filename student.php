<?php
$method = $_SERVER["REQUEST_METHOD"];
include('./class/Student.php');
$student = new Student();

switch($method) {
  case 'GET':
    $id = $_GET['id'];
    if (isset($id)){
      $student = $student->find($id);
      $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
    }else{
      $students = $student->all();
      $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
    }
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  case 'POST':
    $body = file_get_contents("php://input");
    $js_decoded = json_decode($body, true);

    $student = new Student();
    $student->_name = $js_decoded["_name"];
    $student->_surname = $js_decoded["_surname"];
    $student->_sidiCode = $js_decoded["_sidiCode"];
    $student->_taxCode = $js_decoded["_taxCode"];

    $student->post($student);
    $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  case 'DELETE':
    $id = $_GET['id'];
    if(isset($id))
    {
      if($student->delete($id) <= 1)
              $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
      header("Content-Type: application/json");
      echo($js_encode);
    }
    break;

  case 'PUT':
    $body = file_get_contents("php://input");
    $js_decoded = json_decode($body, true);

    $student = new Student();
    $student->_name = $js_decoded["_name"];
    $student->_surname = $js_decoded["_surname"];
    $student->_sidiCode = $js_decoded["_sidiCode"];
    $student->_taxCode = $js_decoded["_taxCode"];
    
    $student->put($student);
    $js_encode = json_encode(array('state'=>TRUE,'student'=>$student),true);
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  default:
    break;
}


?>
