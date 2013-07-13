<?php

namespace Sdz\BlogBundle\Service;

/**
* Un anti-span pour Symfony2
*/
class SdzAntiSpam
{
	/**
	 * Vérifie si le texte est un spam ou non.
	 * Un texte est comme spam à partir de 3 liens
	 * ou adresses e-mails dans son contenu.
	 *
	 * @param string $text
	 */
	public function isSpam($text)
	{
		if (($this->countLinkg($text) + $this->countMails($text)) >= 3)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Compte les URL dans $text
	 *
	 * @param string $text
	 */
	private function countLinks($text)
	{
		preg_match_all(
			'#(http|https|ftp)://([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/?#i',
			$text,
			$matches);

		return count($matches[0]);
	}

	/**
	 * Compte les e-mails de $text
	 *
	 * @param string $text 
	 */
	private function countMails($text)
	{
		preg_match_all(
			'#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}#i',
			$text,
			$matches);

		return count($matches[0]);
	}
}