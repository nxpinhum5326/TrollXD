<?php

namespace scher\trollxd\cmd;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use pocketmine\utils\TextFormat;

use scher\trollxd\forms\AdminTrollForm;
use scher\trollxd\Loader;

class TrollCmd extends Command implements PluginOwned {
	private $plugin;

	public function __construct(
		 Loader $plugin
	) {
		$cfg = $this->plugin->getConfig();

		parent::__construct(
			"trollxd",
			"Troll command",
			"/troll <playerName>",
			["troll"]
		);

		$this->setPermission("trollxd.command.permission");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args): void {
		$plugin = $this->getOwningPlugin();
		if ($sender instanceof ConsoleCommandSender) {
			$sender->sendMessage($plugin->getError("command"));
			return;
		}
		if (!isset($args[0])) {
			$sender->sendMessage($this->getUsage());
			return;
		}

		$player = Loader::getInstance()->getServer()->getPlayerByPrefix($args[0]);
		if ($player instanceof Player and $player->isOnline()) {
			$sender->sendForm(new AdminTrollForm($player, "Troll", "Choose a troll :troll_face:"));
		}else
			$sender->sendMessage($plugin->getError("player-offline"));
	}

	public function getOwningPlugin(): Loader {
		return $this->plugin;
	}
}
