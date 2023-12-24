<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\Loader;

class FakeBan extends Troll {

    public function action(Player $trolled): void {
		$m = Loader::getInstance()->getManager()->getTrollMessage($this->getName());

		if ($trolled->isOnline()) {
			$trolled->kick($m, null, $m);
		}
    }

	public function getName(): string {
		return "fakeban";
	}
}