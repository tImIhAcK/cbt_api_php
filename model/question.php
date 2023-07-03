<?php

/**
 * 
 */
class Question
{
	private $conn;

	public $id;
	public $title;
	public $option_a;
	public $option_b;
	public $option_c;
	public $option_d;
	public $answer;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM question ORDER BY id DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function show(){
		$query = 'SELECT * FROM question WHERE id=? LIMIT 1';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->title = $row['title'];
		$this->option_a = $row['option_a'];
		$this->option_b = $row['option_b'];
		$this->option_c = $row['option_c'];
		$this->option_d = $row['option_d'];
		$this->answer = $row['answer'];
	}

	public function create()
	{
		$query = "INSERT INTO question SET title=:title, option_a=:option_a, option_b=:option_b, option_c=:option_c, option_d=:option_d, answer=:answer";
		$stmt = $this->conn->prepare($query);

		// Clean data
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->option_a = htmlspecialchars(strip_tags($this->option_a));
		$this->option_b = htmlspecialchars(strip_tags($this->option_b));
		$this->option_c = htmlspecialchars(strip_tags($this->option_c));
		$this->option_d = htmlspecialchars(strip_tags($this->option_d));
		$this->answer = htmlspecialchars(strip_tags($this->answer));

		// bind
		$stmt->bindParam(':title', $this->title);
		$stmt->bindParam(':option_a', $this->option_a);
		$stmt->bindParam(':option_b', $this->option_b);
		$stmt->bindParam(':option_c', $this->option_c);
		$stmt->bindParam(':option_d', $this->option_d);
		$stmt->bindParam(':answer', $this->answer);

		if ($stmt->execute()) {
			return true;
		}
		printf('Error %s.\n' ,$stmt->error);
		return false;
	}

	public function update()
	{
		$query = "UPDATE question 
			SET title=:title, option_a=:option_a, option_b=:option_b, option_c=:option_c, option_d=:option_d, answer=:answer
			WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		// Clean data
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->option_a = htmlspecialchars(strip_tags($this->option_a));
		$this->option_b = htmlspecialchars(strip_tags($this->option_b));
		$this->option_c = htmlspecialchars(strip_tags($this->option_c));
		$this->option_d = htmlspecialchars(strip_tags($this->option_d));
		$this->answer = htmlspecialchars(strip_tags($this->answer));
		$this->id = htmlspecialchars(strip_tags($this->id));

		// bind
		$stmt->bindParam(':title', $this->title);
		$stmt->bindParam(':option_a', $this->option_a);
		$stmt->bindParam(':option_b', $this->option_b);
		$stmt->bindParam(':option_c', $this->option_c);
		$stmt->bindParam(':option_d', $this->option_d);
		$stmt->bindParam(':answer', $this->answer);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}
		printf('Error %s.\n' ,$stmt->error);
		return false;
	}

	public function delete()
	{
		$query = "DELETE FROM question WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		// Clean data
		$this->id = htmlspecialchars(strip_tags($this->id));

		// bind
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}
		printf('Error %s.\n' ,$stmt->error);
		return false;
	}


}