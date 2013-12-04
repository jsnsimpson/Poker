<?php
namespace Players;

/**
 * Representation of a Player.
 * 
 * @author Jason Simpson <jsnsimpson@googlemail.com>
 */
class Player 
{
	
	private $name;
	private $balance;
	private $hand;

	/**
	 * Create a player object
	 */
	public function __construct() {
		
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($n) {
		$this->name = $n;
	}
	
	public function setBalance($amount) {
		$this->balance = $amount;	
	}
	
	public function getBalance() {
		return $this->balance;
	}	
	
	public function setHand($hand) {
		$this->hand = $hand;
	}
	
	public function getHand() {
		return $this->hand;
	}
}