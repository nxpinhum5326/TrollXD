<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\entities\FakePrimedTNT;

class FakeTNT extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			$this->sendMessage($trolled);
		}

		$entity = new FakePrimedTNT($trolled->getLocation()); //without explodeA()
		$entity->spawnToAll();
	}

	public function getName(): string {
		return "faketnt";
	}
}
