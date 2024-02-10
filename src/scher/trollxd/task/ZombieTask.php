<?php

namespace scher\trollxd\task;

use pocketmine\entity\Zombie;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class ZombieTask extends Task {
	private $trolled, $zombie, $end;

	public function __construct(Player $trolled, Zombie $zombie) {
		$this->trolled = $trolled;
		$this->zombie = $zombie;
		$this->end = time() + 5;
	}

	public function onRun(): void {
		if (time() >= $this->end) {
			$this->zombie->close();

			$this->getHandler()->cancel();
		}
	}
}
