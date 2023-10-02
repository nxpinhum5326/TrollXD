<?php

namespace scher\trollxd\cmd;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use scher\trollxd\forms\AdminTrollForm;
use scher\trollxd\Loader;

class TrollCmd extends Command {

	public function __construct() {
		parent::__construct("troll", "Troll command", "/troll <playerName>", ["xd"]);
		$this->setPermission("troll.command.permission");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args): void {
		if ($sender instanceof ConsoleCommandSender) return;

		if (!isset($args[0])) {
			$sender->sendMessage($this->getUsage());
			return;
		}

		$player = Loader::getInstance()->getServer()->getPlayerByPrefix($args[0]);
		if ($player instanceof Player and $player->isOnline()) {
			#todo
			$sender->sendForm(new AdminTrollForm($player, "Troll", "Choose a troll :troll_face:"));
		}else $sender->sendMessage(TextFormat::RED ."Player isn't online or wrong target name!");
	}
}
