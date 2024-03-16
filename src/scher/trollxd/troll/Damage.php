<?php

declare(strict_types=1);

namespace scher\trollxd\troll;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\player\Player;

class Damage extends Troll {
	private int $damage;

	public function __construct(
		int $damage) {
		$this->damage = $damage;
	}

	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			$trolled->attack(new EntityDamageEvent($trolled, EntityDamageEvent::CAUSE_SUICIDE, $this->getDamage()));
		}
	}

	public function getDamage(): int {
		return $this->damage ?? 1;
	}

	public function getName(): string {
		return "damage";
	}
}
