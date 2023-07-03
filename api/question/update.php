<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/question.php');

$db = new db();
$connect = $db->connect();

$question = new Question($connect);

$data = json_decode(file_get_contents('php://input'));
$question->id = $data->id;
$question->title = $data->title;
$question->option_a = $data->option_a;
$question->option_b = $data->option_b;
$question->option_c = $data->option_c;
$question->option_d = $data->option_d;
$question->answer = $data->answer;

if ($question->update()) {
	echo json_encode(array('message'=>'Question updated'));
} else {
	echo json_encode(array('message'=>'Error updating question'));	
}
