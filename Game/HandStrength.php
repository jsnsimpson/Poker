<?php
namespace Game;

/**
 * A helper class to calculate the hand strength given.
 * Composed of functions to be called by any 
 * class needing to know the strength of a poker hand.
 * 
 * @author Jason Simpson <jsnsimpson@googlemail.com>
 * @version 1.0
 */
class HandStrength {
	
	const HIGH_CARD = 0;
	const PAIR = 1;
	const TWO_PAIR = 2;
	const THREE_OF_A_KIND = 3;
	const STRAIGHT = 4;
	const FLUSH = 5;
	const FULL_HOUSE = 6;
	const FOUR_OF_A_KIND = 7;
	const STRAIGHT_FLUSH = 8;
	
	private $sortedHand;
	private $strength;
	/**
	 * There must be a hand for us to figure out the hand strength
	 * There may or may not be community cards depending on the 
	 * variety of poker. 
	 * 
	 * @param array $hand
	 * @param array $commCards
	 */
	public function __construct($hand, $commCards=array()) {
		
		//set the sortedHand array. 
		$sortedHand = array_merge($hand, $commCards);
		usort($this->sortedHand, "sortHand");
		$this->strength = HandStrength::HIGH_CARD;
	}
	
	/**
	 * This static method is responsible for calculating the strength of the hand that 
	 * is being held. Pass it two arrays of cards, the hand held by the player and
	 * the community cards. This is all we need to decide. 
	 * 
	 * The function will return an integer representation of the strength of the hand. 
	 * The constants relating to these integers are also found in this class as static constants.
	 * @param array<Card> $hand 
	 * @param array<Card> $commCards
	 * @return integer - the tier of hand that is held.
	 */
	public function calculateHandStrength() {

		//first check if a flush - its not expensive.
		$handStrength = -1;
		$isFlush = false;
		$isStraight = false;
		$hasThreeOfAKind = false;
		$hasPair = false;
		$bypassChecks = false;
		
		
		if(!$bypassChecks && PokerHands::isFourOfAKind($this->sortedHand)) {
			$handStrength = HandStrength::FOUR_OF_A_KIND;
			$bypassChecks = true;
		}
		if(!$bypassChecks && PokerHands::isFlush($this->sortedHand)) {
			$handStrength = HandStrength::FLUSH;
		} 
		
		if(!$bypassChecks && PokerHands::isStraight($this->sortedHand)) {
			if($handStrength == HandStrength::FLUSH) {
				//must be a straight flush!
				$handStrength = HandStrength::STRAIGHT_FLUSH;
			} else {
				$handStrength == HandStrength::STRAIGHT;
			}
		} 
		
		
		$this->strength = $handStrength;
		return $handStrength;
	}
		
	private  function sortHand($a, $b) {
		if ($a->getCardNo() == $b->getCardNo()) {
			return 0;
		}
		else if ($a->getCardNo() > $b->getCardNo()) {
			return 1;
		}
		else {
			return -1;
		}
	}
	
	/**
	 * In the event that two or more players are tied 
	 * we need to distinguish between them based on who
	 * has the highest card. i.e. in a flush an Ace high
	 * flush beats a King high flush.
	 * TODO: different values for different hand types.
	 * @return int - numerical value 
	 */
	public function getHighestHand() {
		$handValue = 0;
		for($i = 2; $i < count($this->sortedHand); $i++) {
			$card = $this->sortedHand[$i];
			$handValue += $card->getCardNo();
		}
		return $handValue;
	}
	

}