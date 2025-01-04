<?php

# from pocketmine
/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
 */

declare(strict_types=1);

namespace scher\trollxd\entities;

use pocketmine\world\World;
use pocketmine\world\Position;
use pocketmine\block\Block;
use pocketmine\block\RuntimeBlockStateRegistry;
use pocketmine\block\TNT;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityExplodeEvent;
use pocketmine\item\VanillaItems;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Vector3;
use pocketmine\utils\AssumptionFailedError;
use pocketmine\world\format\SubChunk;
use pocketmine\world\particle\HugeExplodeSeedParticle;
use pocketmine\world\sound\ExplodeSound;
use pocketmine\world\utils\SubChunkExplorer;
use pocketmine\world\utils\SubChunkExplorerStatus;
use function ceil;
use function floor;
use function min;
use function mt_rand;
use function sqrt;

class FakeExplosion{
	private int $rays = 16;
	public World $world;

	/** @var Block[] */
	public array $affectedBlocks = [];
	public float $stepLen = 0.3;

	private SubChunkExplorer $subChunkExplorer;

	public function __construct(
		public Position $source,
		public float $radius,
		private Entity|Block|null $what = null
	){
		if(!$this->source->isValid()){
			throw new \InvalidArgumentException("Position does not have a valid world");
		}
		$this->world = $this->source->getWorld();

		if($radius <= 0){
			throw new \InvalidArgumentException("Explosion radius must be greater than 0, got $radius");
		}
		$this->subChunkExplorer = new SubChunkExplorer($this->world);
	}

	/**
	 * Damage etc. removed
	 */
	public function explodeB() : bool{
		$source = (new Vector3($this->source->x, $this->source->y, $this->source->z))->floor();
		$yield = min(100, (1 / $this->radius) * 100);

		if($this->what instanceof Entity){
			$ev = new EntityExplodeEvent($this->what, $this->source, $this->affectedBlocks, $yield);
			$ev->call();
			if($ev->isCancelled()){
				return false;
			}else{
				$yield = $ev->getYield();
				$this->affectedBlocks = $ev->getBlockList();
			}
		}

		$explosionSize = $this->radius * 2;
		$minX = (int) floor($this->source->x - $explosionSize - 1);
		$maxX = (int) ceil($this->source->x + $explosionSize + 1);
		$minY = (int) floor($this->source->y - $explosionSize - 1);
		$maxY = (int) ceil($this->source->y + $explosionSize + 1);
		$minZ = (int) floor($this->source->z - $explosionSize - 1);
		$maxZ = (int) ceil($this->source->z + $explosionSize + 1);

		$explosionBB = new AxisAlignedBB($minX, $minY, $minZ, $maxX, $maxY, $maxZ);

		$air = VanillaItems::AIR();
		$airBlock = VanillaBlocks::AIR();

		foreach($this->affectedBlocks as $block){
			$pos = $block->getPosition();
			if($block instanceof TNT){
				$block->ignite(mt_rand(10, 30));
			}else{
				if(mt_rand(0, 100) < $yield){
					foreach($block->getDrops($air) as $drop){
						$this->world->dropItem($pos->add(0.5, 0.5, 0.5), $drop);
					}
				}
				if(($t = $this->world->getTileAt($pos->x, $pos->y, $pos->z)) !== null){
					$t->onBlockDestroyed(); //needed to create drops for inventories
				}
				$this->world->setBlockAt($pos->x, $pos->y, $pos->z, $airBlock);
			}
		}

		$this->world->addParticle($source, new HugeExplodeSeedParticle());
		$this->world->addSound($source, new ExplodeSound());

		return true;
	}   
}
