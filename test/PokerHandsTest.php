<?php


use Game\PokerHands;
require_once("../Game/PokerHands.php");
require_once("../Cards/Card.php");
require_once("../Cards/CardMappings.php");
require_once("../Game/HandStrength.php");
use Cards\Card;
use Game\HandStrength;

$cardArray = array();
$cardArray[] = new Card("11d");
$cardArray[] = new Card("11h");
$cardArray[] = new Card("10d");
$cardArray[] = new Card("9d");
$cardArray[] = new Card("2s");
$cardArray[] = new Card("5d");
$cardArray[] = new Card("5d");

$handStrength = new HandStrength($cardArray);
echo $handStrength->calculateHandStrength();


if(PokerHands::isFlush($cardArray)) {
	echo "flush";
} else {
	echo "not flush";
}
echo "\n";

$cardArray = array();
$cardArray[] = new Card("1h");
$cardArray[] = new Card("2s");
$cardArray[] = new Card("3h");
$cardArray[] = new Card("8c");
$cardArray[] = new Card("10s");
$cardArray[] = new Card("12s");
$cardArray[] = new Card("13d");


if(PokerHands::isStraight($cardArray)) {
	echo "straight";
} else {
	echo "not straight";
}


echo "\n";


