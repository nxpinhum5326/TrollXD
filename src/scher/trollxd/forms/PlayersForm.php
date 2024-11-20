<?php

declare(strict_types=1);

namespace scher\trollxd\forms;

use dktapps\pmforms\CustomForm;
use dktapps\pmforms\CustomFormResponse;
use dktapps\pmforms\element\Dropdown;
use dktapps\pmforms\element\Label;
use pocketmine\player\Player;
use pocketmine\Server;
use scher\trollxd\managers\Manager;
use scher\trollxd\utils\Lang;

class PlayersForm extends CustomForm {
	public function __construct(Player $admin, string $title) {
		$onlinePlayers = Manager::getInstance()->getOnlinePlayers($admin);
		$elements[] = new Label("label1", Lang::translate("form.players.description"));
		if (empty($onlinePlayers)) {
			$elements[] = new Label("label2", Lang::translate("form.players.noplayers"));
		} else {
			$elements[] = new Dropdown("element3", "Players", $onlinePlayers);
		}
		parent::__construct($title, $elements, function(Player $player, CustomFormResponse $response) use ($admin, $onlinePlayers): void {
			if($this->getElementByName("element3") === null)
				return;

			$dropdown = $response->getInt("element3");
			$dropdownVal = $onlinePlayers[$dropdown] ?? null;
			if($dropdownVal != null){
				$goingToBeTrolled = Server::getInstance()->getPlayerExact($dropdownVal);
				if($goingToBeTrolled != null){
					$player->sendForm(new AdminTrollForm($goingToBeTrolled, "Troll", "Choose a troll :troll_face:"));
				}else{
					$player->sendMessage(Lang::translate("general.player.offline"));
				}
			}
		});
	}
}