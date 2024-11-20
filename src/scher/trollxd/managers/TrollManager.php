<?php

namespace scher\trollxd\managers;

use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use scher\trollxd\troll\Troll;

class TrollManager {
	use SingletonTrait;

	public function doTroll(Player $admin, Player $trolled, Troll $troll): void {
		$troll->action($admin, $trolled);
	}

	public function doTrolls(Player $admin, Player $trolled, array $trolls) : void {
		foreach ($trolls as $troll) {
			if ($troll instanceof Troll) {
				$troll->action($admin, $trolled);
			}
		}
	}
}
