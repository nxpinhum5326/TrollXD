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
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, new FakeOP());
			}elseif ($option == 1) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, new FakeBan());
			}elseif ($option == 2) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, new AntiCheat());
			}elseif ($option == 3) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, new Damage(6));
			}elseif ($option == 4) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, new FakeTNT());
			}elseif ($option == 5) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, new ZombieSound());
			}elseif ($option === 6) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, new Flip());
			}elseif ($option === 7) {
				Manager::getInstance()->sendLog($admin->getName(), $goingToBeTrolled->getName(), "crash");
				$crashPk = RemoveActorPacket::create($goingToBeTrolled->getId());
				$goingToBeTrolled->getNetworkSession()->sendDataPacket($crashPk);
			}elseif ($option === 8) {
				TrollManager::getInstance()->doTroll($admin, $goingToBeTrolled, new FakeInventoryClear());
			}
		});
	}
}
