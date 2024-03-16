<?php

namespace scher\trollxd\troll;

use pocketmine\network\mcpe\NetworkBroadcastUtils;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;
use scher\trollxd\entities\FakeZombie;
use scher\trollxd\Loader;
use scher\trollxd\task\ZombieTask;

class ZombieSound extends Troll {
	public function action(Player $admin, Player $trolled): void {
		parent::action($admin, $trolled);
		if ($trolled->isOnline()) {
			$zombie = new FakeZombie($trolled->getLocation());
			$zombie->spawnToAll();
			Loader::getInstance()->getScheduler()->scheduleRepeatingTask(new ZombieTask($trolled, $zombie), 20);
			NetworkBroadcastUtils::broadcastPackets([$trolled], [PlaySoundPacket::create("mob.zombie.say", $trolled->getPosition()->getX(), $trolled->getPosition()->getY(), $trolled->getPosition()->getZ(), 20, 1)]);
		}
    }

    public function getName(): string {
        return "zombiesound";
    }
}
