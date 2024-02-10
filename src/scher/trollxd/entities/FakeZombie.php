<?php

declare(strict_types=1);

namespace scher\trollxd\entities;

use pocketmine\entity\Zombie;
use pocketmine\event\entity\EntityDamageEvent;

class FakeZombie extends Zombie{
	public function attack(EntityDamageEvent $source): void {
		$source->cancel();
	}
}
