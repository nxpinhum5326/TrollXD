<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use scher\trollxd\Loader;

class AntiCheat extends Troll {

	public function action(Player $trolled): void {
		$trolled->sendMessage(Loader::getInstance()->getManager()->getAntiCheatMessage());
	}

}
