<?php

namespace scher\trollxd\task;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use scher\trollxd\Loader;
use scher\trollxd\troll\Freeze;

class FreezeTask extends Task {

	private $trolled, $freezeTime, $unFreeze;

	public function __construct(Player $trolled, int $freezeTime) {
		$this->trolled = $trolled;
		$this->freezeTime = $freezeTime;
		$this->unFreeze = time() + $freezeTime;
	}

	public function onRun(): void {
		if (time() >= $this->unFreeze) {
			$this->trolled->sendMessage("It was a joke...");

			unset(Loader::getInstance()->freezePlayers[$this->trolled->getName()]);

			$this->trolled->setMovementSpeed(0.1);

			$this->getHandler()->cancel();
		}
	}
}
