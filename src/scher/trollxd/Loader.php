<?php

namespace scher\trollxd;

use pocketmine\plugin\PluginBase;
use scher\trollxd\cmd\TrollCmd;
use scher\trollxd\managers\Manager;
use scher\trollxd\managers\TrollManager;

class Loader extends PluginBase {

	protected static Loader $instance;

	public $freezePlayers = [];

	private TrollManager $trollManager;

	private Manager $manager;

	protected function onLoad(): void {
		self::$instance = $this;
		$this->trollManager = new TrollManager($this);
		$this->manager = new Manager();
	}

	protected function onEnable(): void {
		$this->getLogger()->info("TrollXD 1.0.0 is enabled, if you have a suggestion or smt. reach out to @nepinhum discord user!");

		$this->getServer()->getCommandMap()->register("troll",  new TrollCmd());

		$this->saveDefaultConfig();
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
