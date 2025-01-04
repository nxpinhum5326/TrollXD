<?php

namespace scher\trollxd\forms;

use dktapps\pmforms\{MenuOption, MenuForm};
use pocketmine\network\mcpe\protocol\RemoveActorPacket;
use pocketmine\player\Player;
use scher\trollxd\troll\{Damage, FakeInventoryClear, Flip, ZombieSound, FakeBan, FakeTNT, FakeOP, AntiCheat};
use scher\trollxd\managers\Manager;
use scher\trollxd\managers\TrollManager;
use scher\trollxd\utils\Lang;

class AdminTrollForm extends MenuForm {
	public function __construct(Player $goingToBeTrolled, string $title, string $text) {
		parent::__construct($title, $text, [
			new MenuOption(Lang::translate("form.troll.button.fakeop")),
			new MenuOption(Lang::translate("form.troll.button.fakeban")),
			new MenuOption(Lang::translate("form.troll.button.anticheat")),
			new MenuOption(Lang::translate("form.troll.button.damage")),
			new MenuOption(Lang::translate("form.troll.button.faketnt")),
			new MenuOption(Lang::translate("form.troll.button.zombie")),
			new MenuOption(Lang::translate("form.troll.button.flip")),
			new MenuOption(Lang::translate("form.troll.button.crash")),
			new MenuOption(Lang::translate("form.troll.button.invclear"))
		], function (Player $admin, int $option)use ($goingToBeTrolled): void {
			if ($option == 0) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, "fakeop");
			}elseif ($option == 1) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, "fakeban");
			}elseif ($option == 2) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, "anticheat");
			}elseif ($option == 3) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, "damage");
			}elseif ($option == 4) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, "faketnt");
			}elseif ($option == 5) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, "zombiesound");
			}elseif ($option === 6) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, "flip");
			}elseif ($option === 7) {
				Manager::getInstance()->sendLog($admin->getName(), $goingToBeTrolled->getName(), "crash");
				$crashPk = RemoveActorPacket::create($goingToBeTrolled->getId());
				$goingToBeTrolled->getNetworkSession()->sendDataPacket($crashPk);
			}else{
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, "invclear");
			}
		});
	}
}
