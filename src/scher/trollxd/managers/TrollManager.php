<?php

namespace scher\trollxd\managers;

use pocketmine\player\Player;
use scher\trollxd\Loader;
use scher\trollxd\troll\Freeze;
use scher\trollxd\troll\Troll;

class TrollManager {

	private $plugin;

	public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
	}

	public function doTroll(Player $trolled, Troll $troll): void {
		$troll->action($trolled);
	}

	public function doTrolls(Player $trolled, array $trolls) : void {
		foreach ($trolls as $troll) {
			if ($troll instanceof Troll) {
				$troll->action($trolled);
			}
		}
	}
}
