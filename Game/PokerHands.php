<?php
namespace Game;

/**
 * 
 * @author Jason Simpson
 * @version 1.0
 *
 */
class PokerHands {
	
	public static function isStraightFlush($hand) {
		if(HandStrength::isFlush($hand) && HandStrength::isStraight($hand)) {
			return true;
		}
		return false;
	}
	
	public static function isFourOfAKind($hand) {
		return false;
	}
	
	public static function isFullHouse($hand) {
		return false;
	}
	
	/**
	 * Determines if the array $hand passed in contains a flush (expects an array of Card objects).
	 * 
	 * @param array $hand
	 * @return boolean
	 */
	public static function isFlush($hand) {
		$recordSuits = array();
		foreach($hand as $card) {
			
			if(isset($recordSuits[$card->getSuit()])) {
				$recordSuits[$card->getSuit()]++;
				if($recordSuits[$card->getSuit()] >= 5) {
					return true;
				}
			} else {
				$recordSuits[$card->getSuit()] = 1;
				
				//if there are 4 suits at any point, then it is impossible to have a flush. - only execute on creation of a suit
				if(count($recordSuits) == 4) {
					break;
				}
			}
		}
		return false;
	}
	
	/**
	 * Determines if the PRE-SORTED array contains a straight of any kind.
	 * @param array $hand - must be sorted from low to high.
	 * @return boolean
	 */
	public static function isStraight($hand) {
		$lastCard = -1;
		$continueStreak = 1;
		foreach($hand as $card) {
			//if this card is one greater than the last card then continue the streak.
			if(($lastCard+1) == $card->getCardNo()) {
				$continueStreak++;
				if($continueStreak == 5) {
					return true;
				} else if($card->getCardNo() == 13 && $continueStreak == 4) {
					//ace can be high and low  so check if the first card was one (1) -> (ace)
					if($hand[0]->getCardNo() == 1) {
						return true;
						break;
					} else {
						$continueStreak = 1;
					}
				}
			} else if($lastCard != 13) {
				$continueStreak = 1;
			} 
			$lastCard = $card->getCardNo();
		}
		return false;
	}
	
	/**
	 * Determines if the hand is three of a kind
	 * @param array $hand
	 * @see PokerHands::frequentOccurringNumber()
	 * @return boolean
	 */
	public static function isThreeOfAKind($hand) {
		$threeOfAKind = false;
		$commonCards = PokerHands::frequentOccurringNumber($hand);
		foreach($commonCards as $key => $val) {
			if($commonCards[$key] == 3 ) {
				$threeOfAKind = true;				
			}
		}
		
		return $threeOfAKind;
	}
	
	/**
	 * returns the count of the most frequently occuring number
	 * this is a helper function to figure out if x of a kind exist
	 * i.e. if PokerHands::frequentOccurringNumber($hand) == 4 then 
	 * the hand is four of a kind.
	 * @param array $hand - array of Card objects.
	 * @return number
	 */
	public static function frequentOccurringNumber($hand) {
		$countNumbers = array();
		$highestCount = 1;
		foreach($hand as $card) {
			if(isset($countNumbers[$card->getCardNo()])) {
				$countNumbers[$card->getCardNo()]++;
				if($highestCount < $countNumbers[$card->getCardNo()]) {
					$highestCount = $countNumbers[$card->getCardNo()];
					//4 is max.
					if($highestCount == 4) {
						$highestCount = 4;
						break;
					}
				}
			} else {
				$countNumbers[$card->getCardNo()] = 1;
			}
		}
		return $countNumbers;
	}
	
	public static function isTwoPair($hand) {
		return false;
	}
	
	public static function isPair($hand) {
		return false;
	}
	
}