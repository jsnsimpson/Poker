<?php
namespace Cards;

/**
 * Mapping of numbers to real names
 * Helps establish Ace Jack Queen King etc.
 * 
 * @author Jason Simpson
 *
 */
class CardMappings {
	
	private static $numberMap = array(
		1 => "Ace",
		2 => "Two",
		3 => "Three",
		4 => "Four",
		5 => "Five",
		6 => "Six",
		7 => "Seven",
		8 => "Eight",
		9 => "Nine",
		10 => "Ten",
		11 => "Jack",
		12 => "Queen",
		13 => "King"
	);
	
	private static $suitMap = array(
		"d" => "Diamonds",
		"h" => "Hearts",
		"s" => "Spades",
		"c" => "Clubs"
	);
	
	public static function getCardName($suit, $number) {
		return CardMappings::getNumberName($number) . " " . CardMappings::getSuitName($suit);
	}
	
	public static function getNumberName($number) {
		if(isset(CardMappings::$numberMap[$number])) {
			return CardMappings::$numberMap[$number];
		}
		return false;
	}
	
	public static function getSuitName($suit) {
		if(isset(CardMappings::$suitMap[$suit])) {
			return CardMappings::$suitMap[$suit];
		}
		return false;
	}
}