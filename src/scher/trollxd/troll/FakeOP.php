<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\Loader;
use scher\trollxd\utils\Lang;

class FakeOP extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			$trolled->sendMessage(Loader::getInstance()->getManager()->getTrollMessage($this->getName()));
		}
	}

	public function getName(): string {
		return "fakeop";
	}
}
