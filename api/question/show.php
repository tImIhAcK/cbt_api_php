<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/question.php');

$db = new db();
$connect = $db->connect();

$question = new Question($connect);

$question->id = isset($_GET['id']) ? $_GET['id'] : die();
$question->show();

$question_item = array(
	'id'=> $question->id,
	'title'=> $question->title,
	'option_a'=> $question->option_a,
	'option_b'=> $question->option_b,
	'option_c'=> $question->option_c,
	'option_d'=> $question->option_d,
	'answer'=> $question->answer
);


print_r(json_encode($question_item));