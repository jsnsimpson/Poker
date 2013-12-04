<?php
namespace Game;

use Cards\Deck;

/**
 * 
 * @author Jason Simpson
 *
 */
class PokerTable {
	
	private $players;
	private $tableSize;
	private $dealerButtonIndex = 4;
	
	public function __construct($size) {
		$this->tableSize = $size;
		$this->players = array();
		
	}
	
	public function addPlayer($player) {
		if(count($this->players) < $this->getTableSize()) {
			$this->players[] = $player;
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Remove a player from the table
	 * @param Player $player
	 */
	public function removePlayer($player) {
		//find the player in the players array.
		for($i =0; $i < $this->getNumPlayers(); $i++) {
			if($player == $this->players[$i]) {
				//remove the player
				array_splice($this->players, $i, 1);
				break;
			}
		}
	}
	/**
	 * Get the table size.
	 * @return int - the maximum size of the table.
	 */
	public function getTableSize() {
		return $this->tableSize;
	}
	
	public function getNumPlayers() {
		return count($this->players);
	}
	
	public function getPlayer($index) {
		return $this->players[$index];
	}
	
	/**
	 * Commences a new round.
	 */
	public function newRound() {
		$deck = new Deck();
		$poker = new Poker($deck);
		$numPlayers = count($this->players);
		
		$participants = array(); //set the participants with array index 0 being the 1st player to get dealt to. (small blind).
		//give each player their hand - need to start at small blind and move through players to end and reiterate over the start
		for($i = ($this->dealerButtonIndex); $i < $numPlayers; $i++) {
			array_push($participants, $this->players[$i]);
		}
		
		for($i=0; $i < ($this->dealerButtonIndex); $i++) {
			array_push($participants, $this->players[$i]);
		}
		$poker->setParticipants($participants);
		
		$poker->dealCards();
		
		return $poker;
		
	}
}