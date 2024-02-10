<?php

declare(strict_types=1);

namespace scher\trollxd\entities;

use pocketmine\entity\object\PrimedTNT;
use pocketmine\event\entity\EntityPreExplodeEvent;
use pocketmine\world\Explosion;
use pocketmine\world\Position;

class FakePrimedTNT extends PrimedTNT{
	//explodeA removed
	public function explode(): void{
		$ev = new EntityPreExplodeEvent($this, 4);
		$ev->call();
		if(!$ev->isCancelled()){
			$explosion = new Explosion(Position::fromObject($this->location->add(0, $this->size->getHeight() / 2, 0), $this->getWorld()), $ev->getRadius(), $this);
			$explosion->explodeB();
		}
	}
}
