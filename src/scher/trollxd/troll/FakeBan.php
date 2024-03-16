<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\Loader;
use scher\trollxd\utils\Lang;

class FakeBan extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		$m = Loader::getInstance()->getManager()->getTrollMessage($this->getName());

		if ($trolled->isOnline()) {
			$trolled->kick($m, null, $m);
		}
    }

	public function getName(): string {
		return "fakeban";
	}
}
