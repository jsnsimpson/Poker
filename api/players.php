<?php


$players = array(
	array(
		"name" => "Jason Simpson",
		"balance" => 1000,
	),
	array(
		"name" => "Sarah Simpson",
		"balance" => 1000,
		"you" => true
	),
	array(
		"name" => "Adam Simpson",
		"balance" => 1000
	),
);


echo json_encode($players);

?>