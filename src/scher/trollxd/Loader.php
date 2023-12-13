<?php

namespace scher\trollxd;

use pocketmine\plugin\PluginBase;
use scher\trollxd\cmd\TrollCmd;
use scher\trollxd\managers\Manager;
use scher\trollxd\managers\TrollManager;

class Loader extends PluginBase {
	protected static Loader $instance;
	private TrollManager $trollManager;
	private Manager $manager;

	protected function onLoad(): void {
		self::$instance = $this;
		$this->trollManager = new TrollManager($this);
		$this->manager = new Manager();
	}

	protected function onEnable(): void {
		$this->getServer()->getCommandMap()->register("trollxd", new TrollCmd($this));
		$this->saveDefaultConfig();
	}

	public function getError(string $type): string {
		return match ($type) {
			"command" => str_replace("{this}", "TrollXD", $this->getConfig()->getNested("messages.error.command")),
			"player-offline" => $this->getConfig()->getNested("messages.error.player-offline"),
			default => 'Error type, not found.',
		};
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
