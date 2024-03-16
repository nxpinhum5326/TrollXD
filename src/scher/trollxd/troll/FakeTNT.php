<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\entities\FakePrimedTNT;
use scher\trollxd\Loader;
use scher\trollxd\utils\Lang;

class FakeTNT extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
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
