<?php
namespace Game;

use Cards\Deck;

/**
 * Represents a hand of poker - calculates the winners 
 * and takes the community cards from the deck.
 * 
 * @author Jason Simpson <jsnsimpson@googlemail.com>
 */
class Poker 
{
	private $deck;
	private $communityCards;
	private $players;
	
	public function __construct( Deck $deck) {
		$this->deck = $deck;
		$this->communityCards = array();	
	}
	
	/**
	 * Sets the participants
	 * @param array<Player> $players
	 */
	public function setParticipants($players) {
		$this->players = $players;
	}
	
	public function getParticipants() {
		return $this->players;
	}
	
	/**
	 * Deals the hand
	 */
	public function dealCards() {
	
		$numPlayers = count($this->players);
		$hands = array();
		for($j = 0; $j < 2; $j++) {
			for($k = 0; $k < $numPlayers; $k++) {
				//if this is the second card, just deal a card to the hand.
				if(isset($hands[$k])) {
					$hands[$k]->setCardTwo($this->deck->dealCard());
				} else {
					$hands[$k] = new Hand();
					$hands[$k]->setCardOne($this->deck->dealCard());
				}
			}
		}
		//give each player their hand - need to start at small blind and move through players to end and reiterate over the start
		for($i = 0; $i < $numPlayers; $i++) {
			$this->players[$i]->setHand(array_shift($hands));
		}
	
	}
	
	
	
	/**
	 * Executes the flop - i.e. shows the first 3 community cards
	 * @return array - flop the 3 community cards from the deck
	 */
	public function flop() {
		for($i=0; $i < 3; $i++ ) {
			$this->nextCommunityCard();
		}
		return $this->getCommunityCards();
	}
	
	/**
	 * Unveils the turn ands returns an array of all the community cards
	 * @return array all the community cards
	 * @see Poker::getComunityCards();
	 */
	public function turn() {
		return $this->nextCommunityCard();
	}

	/**
	 * Adds the river card to the community cards.
	 * @return array all the community cards
	 * @see Poker::getComunityCards();
	 */
	public function river() {
		return $this->nextCommunityCard();
	}
	
	/**
	 * Takes one more card from the deck and adds it to the community cards.
	 * @return array - Cards
	 */
	private function nextCommunityCard() {
		$communityCard = $this->deck->dealCard();
		array_push($this->communityCards, $communityCard);
		return $this->getCommunityCards();
	}
	
	/**
	 * 
	 * @return 
	 */
	public function getCommunityCards() {
		return $this->communityCards;
	}

	public function calculateWinner() {
		foreach($this->players as $player) {
			$ranking = HandStrength::calculateHandStrength($player->getHand()->toArray(), $this->getCommunityCards());
		}
	}
	
	protected function getHandStrength() {
		
	}
}