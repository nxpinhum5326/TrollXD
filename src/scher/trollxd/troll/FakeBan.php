<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;

class FakeBan extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			$trolled->kick($this->getMessage(), null, $this->getMessage());
		}
    }

	public function getName(): string {
		return "fakeban";
	}
}
