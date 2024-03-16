<?php

namespace scher\trollxd\managers;

use pocketmine\player\Player;
use scher\trollxd\Loader;

use scher\trollxd\utils\Lang;
use scher\trollxd\utils\WebhookAPI;

class Manager {
	public function __construct(){
		$languages = Loader::getInstance()->getConfig()->get("languages");
		foreach($languages as $language){
			Loader::getInstance()->saveResource("langs/$language.json");
		}

		Lang::init($languages);
	}

	public function sendLog(string $admin, string $trolled, string $trollName): void {
		$webhook = Loader::getInstance()->getConfig()->get("webhookapi");

		if ($webhook != "") {
			WebhookAPI::sendMessage($webhook, Lang::translate("webhook.log",[
				"admin" => $admin,
				"trolled" => $trolled,
				"trollName" => $trollName
			]));
		}
	}

	public function getTrollMessage(string $trollName): string {
		return Lang::translate("message.troll.$trollName");
	}
}
