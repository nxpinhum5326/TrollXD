<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\player\Player;

class Damage extends Troll {
	public const DAMAGE = 1;

	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			$trolled->attack(new EntityDamageEvent($trolled, EntityDamageEvent::CAUSE_SUICIDE, $this->getDamage()));
		}
	}

	public function getDamage(): int {
		return self::DAMAGE;
	}

	public function getName(): string {
		return "damage";
	}
}
