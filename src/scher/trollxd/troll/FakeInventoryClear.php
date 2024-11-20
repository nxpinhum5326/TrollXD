<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\Loader;
use scher\trollxd\task\InvClearTask;

class FakeInventoryClear extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			Loader::getInstance()->getScheduler()->scheduleRepeatingTask(new InvClearTask($trolled, $trolled->getInventory()->getContents()), 20);
			$trolled->getInventory()->setContents([]);
			$this->sendMessage($trolled);
		}
	}

	public function getName(): string {
		return "invclear";
	}
}
