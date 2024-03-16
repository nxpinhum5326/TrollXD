<?php

declare(strict_types=1);

namespace scher\trollxd\utils;

use scher\trollxd\Loader;
use scher\trollxd\task\WebhookTask;

class WebhookAPI {
	public static function sendMessage(string $webhook, string $msg): void {
		$curlopts = [
			"content" => $msg,
			"username" => "TrollXD"
		];

		self::getPlugin()->getServer()->getAsyncPool()->submitTask(new WebhookTask($webhook, serialize($curlopts)));
	}

	public static function getPlugin(): Loader {
		return Loader::getInstance();
	}
}