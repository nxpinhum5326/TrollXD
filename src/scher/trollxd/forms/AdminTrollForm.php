<?php

namespace scher\trollxd\forms;

use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;
use scher\trollxd\Loader;
use scher\trollxd\troll\AntiCheat;
use scher\trollxd\troll\Damage;
use scher\trollxd\troll\FakeOP;
use scher\trollxd\troll\Freeze;

class AdminTrollForm extends MenuForm {

	public function __construct(Player $willBeTrolled, string $title, string $text) {
		#todo : multiple trolling
		parent::__construct($title, $text,
			[
				new MenuOption("FakeOP Message"),
				new MenuOption("Freeze - Block Movement"),
				new MenuOption("AntiCheat Message"),
				new MenuOption("Damage - Itself Damage")
			],
		function (Player $admin, int $option)use ($willBeTrolled): void {
			if ($option == 0) {
				Loader::getInstance()->getTrollManager()->doTroll($willBeTrolled, new FakeOP());
			}elseif ($option == 1) {
				Loader::getInstance()->getTrollManager()->doTroll($willBeTrolled, new Freeze());
			}elseif ($option == 2) {
				Loader::getInstance()->getTrollManager()->doTroll($willBeTrolled, new AntiCheat());
			}elseif ($option == 3) {
				Loader::getInstance()->getTrollManager()->doTroll($willBeTrolled, new Damage());
			}
		});
	}
}
