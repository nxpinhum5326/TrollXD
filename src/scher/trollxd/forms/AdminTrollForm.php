<?php

namespace scher\trollxd\forms;

use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;
use scher\trollxd\Loader;
use scher\trollxd\troll\AntiCheat;
use scher\trollxd\troll\ZombieSound;
use scher\trollxd\troll\Damage;
use scher\trollxd\troll\FakeBan;
use scher\trollxd\troll\FakeOP;
use scher\trollxd\troll\FakeTNT;

class AdminTrollForm extends MenuForm {

	public function __construct(Player $willBeTrolled, string $title, string $text) {
		#todo : multiple trolling
		parent::__construct($title, $text,
			[
				new MenuOption("FakeOP Message"),
				new MenuOption("Fake Ban"),
				new MenuOption("AntiCheat Message"),
				new MenuOption("Damage - Itself Damage"),
				new MenuOption("FakeTNT Explosion"),
				new MenuOption("ZombieSound.exe :]")
			],
		function (Player $admin, int $option)use ($willBeTrolled): void {
			if ($option == 0) {
				Loader::getInstance()->getTrollManager()->doTroll($willBeTrolled, new FakeOP());
			}elseif ($option == 1) {
				Loader::getInstance()->getTrollManager()->doTroll($willBeTrolled, new FakeBan());
			}elseif ($option == 2) {
				Loader::getInstance()->getTrollManager()->doTroll($willBeTrolled, new AntiCheat());
			}elseif ($option == 3) {
				Loader::getInstance()->getTrollManager()->doTroll($willBeTrolled, new Damage(6));
			}elseif ($option == 4) {
				Loader::getInstance()->getTrollManager()->doTroll($willBeTrolled, new FakeTNT());
			}elseif ($option == 5) {
				Loader::getInstance()->getTrollManager()->doTroll($willBeTrolled, new ZombieSound());
			}
		});
	}
}
