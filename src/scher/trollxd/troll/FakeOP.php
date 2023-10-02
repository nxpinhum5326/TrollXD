<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class FakeOP extends Troll {

	public function action(Player $trolled): void {
		$trolled->sendMessage(TextFormat::GRAY . "You are now op!");
	}
}
