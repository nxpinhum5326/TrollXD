<?php

namespace scher\trollxd;

use pocketmine\plugin\PluginBase;
use scher\trollxd\cmd\TrollCmd;
use scher\trollxd\managers\Manager;
use scher\trollxd\managers\TrollManager;
use scher\trollxd\utils\Lang;

class Loader extends PluginBase {

	private static Loader $instance;

	protected function onLoad(): void {
		self::$instance = $this;
	}

	protected function onEnable(): void {
		TrollManager::setInstance(new TrollManager());
		Manager::setInstance(new Manager());

		TrollManager::getInstance()->loadTrolls();

		$this->getServer()->getCommandMap()->register("trollxd", new TrollCmd($this));

		$this->saveDefaultConfig();
	}

	public function tl(string $key): string {
		return Lang::translate($key);
	}


	public static function getInstance(): Loader {
		return self::$instance;
	}
}
