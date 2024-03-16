<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\Loader;

class AntiCheat extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			$trolled->sendTip(Loader::getInstance()->getManager()->getTrollMessage($this->getName()));
			$trolled->sendMessage(Loader::getInstance()->getManager()->getTrollMessage($this->getName()));
		}
	}

	public function getName(): string {
		return "anticheat";
	}
}
