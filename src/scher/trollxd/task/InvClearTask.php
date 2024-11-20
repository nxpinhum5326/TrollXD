<?php

declare(strict_types=1);

namespace scher\trollxd\task;

use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class InvClearTask extends Task {
	private Player $trolled;

	/** @var Item[] */
	private array $contents = [];

	private int $end;

	public function __construct(Player $trolled, array $contents) {
		$this->trolled = $trolled;
		$this->contents = $contents;
		$this->end = time() + 5;
	}

	public function onRun(): void{
		if (time() >= $this->end) {
			$this->trolled->getInventory()->setContents($this->contents);

			$this->getHandler()->cancel();
		}
	}
}