<?php

namespace scher\trollxd;

use pocketmine\plugin\PluginBase;
use scher\trollxd\cmd\TrollCmd;
use scher\trollxd\managers\Manager;
use scher\trollxd\managers\TrollManager;
use scher\trollxd\utils\Lang;

class Loader extends PluginBase {
	private static Loader $instance;
	private TrollManager $trollManager;
	private Manager $manager;

	protected function onLoad(): void {
		self::$instance = $this;
	}

	protected function onEnable(): void {
		$this->trollManager = TrollManager::getInstance();
		$this->manager = Manager::getInstance();
		$this->getServer()->getCommandMap()->register("trollxd", new TrollCmd($this));
		$this->saveDefaultConfig();
	}

	public function tl(string $key): string {
		return Lang::translate($key);
	}

	public function getTrollManager(): TrollManager {
		return $this->trollManager;
	}

	public function getManager(): Manager {
		return $this->manager;
	}

	public static function getInstance(): Loader {
		return self::$instance;
	}
}
