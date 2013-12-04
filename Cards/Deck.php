<?php
namespace Cards;

/**
 * 
 * @author Jason Simpson
 */
class Deck 
{
	private $suits = array('d','h','s','c');
	private $deck;
	
	/**
	 * Constructor function, setup the deck
	 */
	public function __construct() {
		$this->createDeck();
	}
	
	/**
	 * Generates the unsorted deck
	 */
	private function createDeck() {
		$this->deck = array();
		foreach( $this->suits as $suit ) {
			for($i = 1; $i <= 13; $i++) {
				$card = new Card($i . $suit);
				$this->deck[] = $card;
			}
		}
	}
	
	public function shuffle() {
		
	}
	
	public function dealCard() {
		$cardIndex = rand(0, count($this->deck)-1);
		$cards = array_splice($this->deck, $cardIndex, 1);
		return $cards[0];
	}
	
}