<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use Algorithms\LinkedList\LinkedList;

class Index {
  private $linkedList;

  public function __construct() {
    if (!isset($_SESSION['linkedList'])) {
      echo "setting";
      $_SESSION['linkedList'] = serialize(new LinkedList());
    }
    $this->linkedList = unserialize($_SESSION['linkedList']);
  }

  public function renderView($viewName) {
    $viewPath = __DIR__ . '/view/' . $viewName;

    if (file_exists($viewPath)) {
        include $viewPath;
    } else {
        echo "View not found: " . $viewPath;
    }
  }

  public function insertToLinkedList($insertValue, $actionType){
    try{
      if($actionType == 'first'){
        $this->linkedList->insertFirst($insertValue);
      }else{
        $this->linkedList->insertLast($insertValue);
      }
      
      $_SESSION['linkedList'] = serialize($this->linkedList);
      return $this->linkedList->returnHTML();
    }catch(\Exception $e){
      return $e->getMessage();
    }
    return "<h1>{$insertValue}</h1>";
  }

  public function resetList(){
    $_SESSION['linkedList'] = serialize(new LinkedList());
    $this->linkedList = unserialize($_SESSION['linkedList']);
    return $this->linkedList->returnHTML();
  }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/');

$index = new Index();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
  $action = $_GET['action'];
  $data = json_decode(file_get_contents('php://input'), true);

  if($action === 'insert' ){
    if(isset($_GET['type'])){
      if (isset($data['insert_value'])) {
        $insertValue = $data['insert_value'];
        $newListStructure = $index->insertToLinkedList($insertValue, $_GET['type']);
    
        $response = [
          'status' => 'success',
          'message' => 'Data inserted successfully',
          'html' => $newListStructure,
          'type' => $actionType
        ];
    
        header('Content-Type: application/json');
        error_log("Response: " . json_encode($response));
    
        echo json_encode($response);
        exit;
      }
    }
  } else {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['status' => 'error', 'message' => 'Missing insert_value']);
    exit;
  }
}

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])){
  $action = $_GET['action'];

  $response = [
    'status' => true
  ];

  if($action === 'reset-list'){
    $response['html'] = $index->resetList();
  }

  header('Content-Type: application/json');
  error_log("Response: " . json_encode($response));

  echo json_encode($response);
  exit;
}

$index->renderView('display.php');
