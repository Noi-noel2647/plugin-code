<?php

namespace plugin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\ServerSettingsResponsePacket;
use pocketmine\network\mcpe\protocol\ServerSettingsRequestPacket;

class Main extends PluginBase implements Listener{

	public function onEnable(){

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$plugin = "FormTest";
		$this->getLogger()->info("§a".$plugin."§eを読み込みました。 §fTest §b(Noi)");

		$dirname = dirname(__FILE__);
		$json = file_get_contents($dirname."/form_test.json");
		$this->data = json_encode($json);

	}


	public function onData(DataPacketReceiveEvent $event){

		$player = $event->getPlayer();
		$packet = $event->getPacket();

		if ($packet instanceof ServerSettingsRequestPacket) {
			$pk = new ServerSettingsResponsePacket();
			$pk->formId = 100;
			$pk->formData = $this->data;
			$player->dataPacket($pk);
		}
	}
}
