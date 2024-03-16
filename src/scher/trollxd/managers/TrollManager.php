<?php

namespace scher\trollxd\managers;

use pocketmine\player\Player;
use scher\trollxd\Loader;
use scher\trollxd\troll\Troll;

class TrollManager {
	private Loader $plugin;

	public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
	}

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

	public function getPlugin(): Loader {
		return $this->plugin;
	}
}
