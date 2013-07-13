<?php

namespace Setec\SalarieBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SetecSalarieBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
