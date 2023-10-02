<?php

namespace scher\trollxd\managers;

use scher\trollxd\Loader;

class Manager {
	
	public function getAntiCheatPrefix(): string {
		return str_replace("&", "§", Loader::getInstance()->getConfig()->get("anti-cheat-prefix"));
	}

	public function getAntiCheatMessage(): string {
		return $this->getAntiCheatPrefix() . str_replace("&", "§", Loader::getInstance()->getConfig()->get("anti-cheat-message"));
	}
}
