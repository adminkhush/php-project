<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$host = "localhost";
$username = "root";
$password = "";
$database = "assignment";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//dis changes
  $endYear=isset($_GET['endYear'])?intval($_GET['endYear']):null;

  $query = "SELECT * FROM data_1";

  if ($endYear){

  $query .= " WHERE end_year = $endYear";
}
 
//new changes
 $result = $conn->query($query);
  $data = [];
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  $conn->close();
  echo json_encode($data);
}
?>
