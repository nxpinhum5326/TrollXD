<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use scher\trollxd\Loader;

class FakeOP extends Troll {
	public function action(Player $trolled): void {
		if ($trolled->isOnline()) {
			$trolled->sendMessage(Loader::getInstance()->getManager()->getTrollMessage($this->getName()));
		}
	}

	public function getName(): string {
		return "fakeop";
	}
}
