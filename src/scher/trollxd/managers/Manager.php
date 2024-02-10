<?php

namespace scher\trollxd\managers;

use scher\trollxd\Loader;

use function str_contains;
use function str_replace;

class Manager {
	public function getTrollMessage(string $trollName): string {
		$config = Loader::getInstance()->getConfig();
		$search = $config->getNested("messages.troll." . $trollName);

		if ($search !== null) {
			return str_contains($search, "&") ? str_replace("&", "§", $search) : $search;
		}

		return ":(";
	}
}
