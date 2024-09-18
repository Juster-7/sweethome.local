<?php

namespace Database\Factories;

class FactoryHelper 
{
	public static function getFakerHTMLText($faker, $countParagraphs) {
		$paragraphs = $faker->paragraphs($countParagraphs);
		$text = '';
		foreach ($paragraphs as $p) {
			$text .= "<p>$p</p>";
		}
		return $text;
	}
}