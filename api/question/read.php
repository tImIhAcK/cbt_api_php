<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/question.php');

$db = new db();
$connect = $db->connect();

$question = new Question($connect);
$read = $question->read();

$num = $read->rowCount();
if ($num > 0) {
	$question_array = [];
	$question_array['question'] = [];


	while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$question_item = array(
			'id'=>$id,
			'title'=>$title,
			'option_a'=>$option_a,
			'option_b'=>$option_b,
			'option_c'=>$option_c,
			'option_d'=>$option_d,
			'answer'=>$answer
		);
		array_push($question_array['question'], $question_item);
	}
	echo json_encode($question_array);
} else {
	echo "No question available";
}
