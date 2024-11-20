<?php

namespace scher\trollxd\troll;

use pocketmine\player\Player;
use scher\trollxd\managers\Manager;

abstract class Troll {
	public function action(Player $admin, Player $trolled): void {
		Manager::getInstance()->sendLog($admin->getName(), $trolled->getName(), $this->getName());
	}

	public function getMessage(): string{
		if($this->getName() != "")
			return Manager::getInstance()->getTrollMessage($this->getName());

		return "";
	}

	/**
	 * Sends message for the trolled player.
	 *
	 * @param Player $trolled
	 * @return void
	 */
	public function sendMessage(Player $trolled): void{
		$trolled->sendMessage($this->getMessage());
	}

	/**
	 * Sends tip for the trolled player.
	 *
	 * @param Player $trolled
	 * @return void
	 */
	public function sendTip(Player $trolled): void{
		$trolled->sendTip($this->getMessage());
	}

	abstract public function getName(): string;

}
