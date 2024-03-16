<?php

namespace scher\trollxd\cmd;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use scher\trollxd\forms\AdminTrollForm;
use scher\trollxd\Loader;
use scher\trollxd\utils\Lang;

class TrollCmd extends Command implements PluginOwned {
	private Loader $plugin;

	public function __construct(
		 Loader $plugin
	) {
		$this->plugin = $plugin;

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
			$sender->sendMessage(Lang::translate("command.ingame", [
				"this" => "'/trollxd'"
			]));
			return;
		}

		if (!isset($args[0])) {
			$sender->sendMessage($this->getUsage());
			return;
		}

		$player = Loader::getInstance()->getServer()->getPlayerExact($args[0]);
		if ($player instanceof Player and $player->isOnline()) {
			$sender->sendForm(new AdminTrollForm($player, "Troll", "Choose a troll :troll_face:"));
		}else
			$sender->sendMessage(Lang::translate("command.player.offline"));
	}

	public function getOwningPlugin(): Loader {
		return $this->plugin;
	}
}
