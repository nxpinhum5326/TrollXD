<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\Loader;

abstract class Troll {
	public function action(Player $admin, Player $trolled): void {
		Loader::getInstance()->getManager()->sendLog($admin->getName(), $trolled->getName(), $this->getName());
	}

	abstract public function getName(): string;

}
