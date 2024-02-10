<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\entities\FakePrimedTNT;
use scher\trollxd\Loader;

class FakeTNT extends Troll {
	public function action(Player $trolled): void {
		if ($trolled->isOnline()) {
			$trolled->sendMessage(Loader::getInstance()->getManager()->getTrollMessage($this->getName()));
		}

		$entity = new FakePrimedTNT($trolled->getLocation()); //without explodeA()
		$entity->spawnToAll();
	}

	public function getName(): string {
		return "faketnt";
	}
}
