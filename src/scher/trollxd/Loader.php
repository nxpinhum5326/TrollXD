<?php

namespace scher\trollxd;

use pocketmine\plugin\PluginBase;
use scher\trollxd\cmd\TrollCmd;
use scher\trollxd\managers\Manager;
use scher\trollxd\managers\TrollManager;

class Loader extends PluginBase {

	private static Loader $instance;

	public $freezePlayers = [];

	private TrollManager $trollManager;

	private Manager $manager;

	protected function onLoad(): void {
		self::$instance = $this;
		$this->trollManager = new TrollManager($this);
		$this->manager = new Manager();
	}

	protected function onEnable(): void {
		$this->getLogger()->info("usendim brother xd todo");

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
