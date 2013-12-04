<?php
namespace Cards;

class Card {
	
	private $cardNo;
	private $suitName;
	private $cardName;
	
	public function __construct($name) {
		
		$this->configureCard($name);
	}
	
	/**
	 * Takes a string made up of 2 or 3 characters e.g 1d (Ace Diamonds) or 10s (Ten Spades).
	 * @param String $name
	 */
	private function configureCard($name) {

		preg_match('/[0-9]{1,2}/', $name, $nums);
		preg_match('/[a-z]{1}/', $name, $chars);
		
		
		$this->suitName = $chars[0];
		$this->cardNo = $nums[0];
		$this->cardName = CardMappings::getCardName($this->getSuit(), $this->getCardNo());
	}
	
	/**
	 * Returns the full string name of the card i.e. Ace Diamonds
	 * @return string
	 */
	public function getCardName() {
		return $this->cardName;
	}
	
	
	public function getSuit() {
		return $this->suitName;
	}
	
	public function getCardNo() {
		return (int)$this->cardNo;
	}
}