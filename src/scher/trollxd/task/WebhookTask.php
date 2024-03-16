<?php

declare(strict_types=1);

namespace scher\trollxd\task;

use pocketmine\scheduler\AsyncTask;

class WebhookTask extends AsyncTask {
	private string $webhook;
	private string $curlopts;

	public function __construct(string $webhook, string $curlopts) {
		$this->webhook = $webhook;
		$this->curlopts = $curlopts;
	}

	public function onRun(): void {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->webhook);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(unserialize($this->curlopts)));
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($curl);
		$curlerror = curl_error($curl);

		$responsejson = json_decode($response, true);

		$success = false;
		$error = "";

		if( $curlerror != "") {
			$error = "Unkown error occured, sorry xD";
		} elseif (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 204) {
			$error = $responsejson["message"];
		} elseif (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 204 OR $response === "") {
			$success = true;
		}

		$result = ["Response" => $response, "Error" => $error, "success" => $success];
		$this->setResult($result);
	}
}
