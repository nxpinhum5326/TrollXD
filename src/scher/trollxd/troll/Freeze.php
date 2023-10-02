<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use scher\trollxd\Loader;
use scher\trollxd\task\FreezeTask;

class Freeze extends Troll {

	public function action(Player $trolled): void {
		//todo
		$trolled->setMovementSpeed(0);
		//add
		Loader::getInstance()->freezePlayers[$trolled->getName()] = $trolled;
		//task
		Loader::getInstance()->getScheduler()->scheduleRepeatingTask(new FreezeTask($trolled, Loader::getInstance()->getConfig()->get("freeze-time")), 20);
	}

}
