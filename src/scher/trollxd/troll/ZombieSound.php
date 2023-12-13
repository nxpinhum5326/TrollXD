<?php

namespace scher\trollxd\troll;

use pocketmine\entity\Zombie;
use pocketmine\network\mcpe\NetworkBroadcastUtils;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;
use scher\trollxd\Loader;
use scher\trollxd\task\ZombieTask;


class ZombieSound extends Troll {

    public function action(Player $trolled): void {
		if ($trolled->isOnline()) {
			/** @var $zombie */
			$zombie = new Zombie($trolled->getLocation(), null);
			$zombie->spawnToAll();
			Loader::getInstance()->getScheduler()->scheduleRepeatingTask(new ZombieTask($trolled, $zombie), 20);
			NetworkBroadcastUtils::broadcastPackets([$trolled], [PlaySoundPacket::create("mob.zombie.say", $trolled->getPosition()->x, $trolled->getPosition()->y, $trolled->getPosition()->z, 20, 1)]);
		}
    }

    public function getName(): string {
        return "zombiesound";
    }
}