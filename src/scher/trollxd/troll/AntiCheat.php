<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\player\Player;

class AntiCheat extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			$this->sendTip($trolled);
			$this->sendMessage($trolled);
		}
	}

	public function getName(): string {
		return "anticheat";
	}
}
