<?php

namespace scher\trollxd\forms;

use dktapps\pmforms\{MenuOption, MenuForm};
use pocketmine\network\mcpe\protocol\RemoveActorPacket;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\Explosion;
use scher\trollxd\Loader;
use scher\trollxd\troll\{Damage, Flip, ZombieSound, FakeBan, FakeTNT, FakeOP, AntiCheat};

class AdminTrollForm extends MenuForm {
	public function __construct(Player $goingToBeTrolled, string $title, string $text) {
		parent::__construct($title, $text, [
			new MenuOption("FakeOP Message"),
			new MenuOption("Fake Ban"),
			new MenuOption("AntiCheat Message"),
			new MenuOption("Damage - Itself Damage"),
			new MenuOption("FakeTNT Explosion(doesn't break the blocks)"),
			new MenuOption("ZombieSound.exe :]"),
			new MenuOption("Flip.hack xD"),
			new MenuOption("Crash.lol (seriously, it's crashing the game)")
		], function (Player $admin, int $option)use ($goingToBeTrolled): void {
			if ($option == 0) {
				Loader::getInstance()->getTrollManager()->doTroll($goingToBeTrolled, new FakeOP());
			}elseif ($option == 1) {
				Loader::getInstance()->getTrollManager()->doTroll($goingToBeTrolled, new FakeBan());
			}elseif ($option == 2) {
				Loader::getInstance()->getTrollManager()->doTroll($goingToBeTrolled, new AntiCheat());
			}elseif ($option == 3) {
				Loader::getInstance()->getTrollManager()->doTroll($goingToBeTrolled, new Damage(6));
			}elseif ($option == 4) {
				Loader::getInstance()->getTrollManager()->doTroll($goingToBeTrolled, new FakeTNT());
			}elseif ($option == 5) {
				Loader::getInstance()->getTrollManager()->doTroll($goingToBeTrolled, new ZombieSound());
			}elseif ($option === 6) {
				Loader::getInstance()->getTrollManager()->doTroll($goingToBeTrolled, new Flip());
			}elseif ($option === 7) {
				$crashPk = RemoveActorPacket::create($goingToBeTrolled->getId());
				$goingToBeTrolled->getNetworkSession()->sendDataPacket($crashPk);
			}
		});
	}
}
