<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\player\Player;

class Flip extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			$trolled->teleport($trolled->getPosition(), $trolled->getLocation()->getYaw() + 180);
		}
	}

	public function getName(): string {
		return "flip";
	}
}
