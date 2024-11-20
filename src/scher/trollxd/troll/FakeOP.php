<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\player\Player;

class FakeOP extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			$this->sendMessage($trolled);
		}
	}

	public function getName(): string {
		return "fakeop";
	}
}
