<?php

namespace scher\trollxd\managers;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\utils\SingletonTrait;

use scher\trollxd\troll\Troll;
use scher\trollxd\Loader;

use scher\trollxd\troll\AntiCheat;
use scher\trollxd\troll\Damage;
use scher\trollxd\troll\FakeBan;
use scher\trollxd\troll\FakeTNT;
use scher\trollxd\troll\FakeInventoryClear;
use scher\trollxd\troll\FakeOP;
use scher\trollxd\troll\Flip;
use scher\trollxd\troll\ZombieSound;

class TrollManager {
	use SingletonTrait;

	/** @var Troll[] */
	private array $trolls = [];

	public function getAll(): array{
		return $this->trolls;
	}

	public function get(string $name): ?Troll{
		return $this->trolls[$name] ?? null;
	}

	public function add(Troll $troll): void{
		$this->trolls[$troll->getName()] = $troll;
	}

	public function loadTrolls(): void{
		#Loader::getInstance()->getLogger()->info(TextFormat::colorize("&l&cTrollXD &r&7> &2Loading Trolls"));

		$this->add(new AntiCheat());
		$this->add(new Damage());
		$this->add(new FakeBan());
		$this->add(new FakeInventoryClear());
		$this->add(new FakeTNT());
		$this->add(new FakeOP());
		$this->add(new Flip());
		$this->add(new ZombieSound());

		#Loader::getInstance()->getLogger()->info(TextFormat::colorize("&l&cTrollXD &r&7> &2Trolls have loaded"));
	}

	public function doTroll(Player $admin, Player $trolled, string $name): void{
		$troll = $this->get($name);

		if(!is_null($troll)){
			$troll->action($admin, $trolled);
		}
	}

	public function doTrolls(Player $admin, Player $trolled, array $trolls) : void {
		foreach ($trolls as $troll) {
			if ($troll instanceof Troll) {
				$troll->action($admin, $trolled);
			}
		}
	}
}
