<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\Loader;

class FakeBan extends Troll {

    public function action(Player $trolled): void {
		$m = Loader::getInstance()->getManager()->getTrollMessage($this->getName());

		if ($trolled->isOnline()) {
			if (Loader::getInstance()->getManager()->isKickEnabled()) $trolled->kick($m, null, $m);
			else $trolled->sendMessage($m);
		}
    }

	public function getName(): string {
		return "fakeban";
	}
}