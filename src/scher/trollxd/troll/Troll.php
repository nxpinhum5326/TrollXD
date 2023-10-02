<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;

abstract class Troll {

	abstract public function action(Player $trolled): void;

}
