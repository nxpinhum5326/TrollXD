<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;

abstract class Troll {
	abstract public function action(Player $trolled): void;
	abstract public function getName(): string;

}
