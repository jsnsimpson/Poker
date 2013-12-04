<?php
require("Cards/Deck.php");
require("Cards/Card.php");
require("Cards/CardMappings.php");
require("Players/Player.php");
require("Game/Hand.php");
require("Game/Poker.php");
require("Game/PokerTable.php");
require("Game/PokerHands.php");
require("Game/HandStrength.php");





use Game\PokerTable;
use Players\Player;


$table = new PokerTable(9);

for($i = 0; $i < 9; $i++) {
	$player = new Player();
	$player->setName("Player " . ($i+1));
	$player->setBalance(1000); //give everyone 1000 starting chips
	$table->addPlayer($player);
}

$poker = $table->newRound();
echo "-----------------HOLD CARDS---------------------- \n";
foreach($poker->getParticipants() as $player) {
	echo $player->getName() . " : " . $player->getHand()->getCardOne()->getCardName() . "-" . $player->getHand()->getCardTwo()->getCardName() . "\n";
}

echo "--------------------FLOP------------------------- \n";

$flop = $poker->flop();
echo communityCardString($flop) . "\n";

echo "--------------------TURN------------------------- \n";

$turn = $poker->turn();
echo communityCardString($turn) . "\n";

echo "--------------------RIVER------------------------ \n";

$river = $poker->turn();
echo communityCardString($river) . "\n";


echo "--------------------WINNER----------------------- \n";

$poker->calculateWinner();

function communityCardString($cards) {
	$commCards = "";
	foreach($cards as $card) {
		$commCards .= $card->getCardName() . " | ";
	}
	return $commCards;
}