<?php
namespace Game;

class Hand 
{
	private $cardOne;
	private $cardTwo;
	
	/**
	 * Create the hand;
	 */
	public function __construct() {
		
	}
	
	public function setCardOne($card) {
		$this->cardOne = $card;
	}
	
	public function setCardTwo($card) {
		$this->cardTwo = $card;
	}
	
	public function getHand() {
		return array($this->cardOne, $this->cardTwo);
	}
	
	public function getCardOne() {
		return $this->cardOne;
	}
	
	public function getCardTwo() {
		return $this->cardTwo;
	}
	
	public function toArray() {
		return array($this->getCardOne(), $this->getCardTwo());
	}
}