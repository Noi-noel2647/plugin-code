<?php

namespace plugin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use pocketmine\event\entity\EntityLevelChangeEvent
use pocketmine\Player;



class Main extends PluginBase implements Listener {

	public function onEnable()
	{

		$this->getServer()->getPluginManager()->registerEvents($this, $this);


		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(), 0744, true);
		}

		$this->world = new Config($this->getDataFolder() . "config.yml", Config::YAML, array("ワールド名" => "world"));


	}


	public function onLevelChange(EntityLevelChangeEvent $event)
	{

 		$level1 = $event->getOrigin();	//移動前のワールド (Levelオブジェクト)
 		$level2 = $event->getTarget();	//移動後のワールド (Levelオブジェクト)


		$name1 = $level1->getName();	//移動前のワールドの名前 (String)
		$name2 = $level2->getName();	//移動後のワールドの名前 (String)

 		$entity = $event->getEntity();	//移動したEntity (Entityオブジェクト)

		$name = $this->world->get("ワールド名");

		if($name2 == $name){	//$name2が$nameかどうか比較

			//$name2が$nameと同じだった場合の処理

			if($entity instanceof Player){	//$entityがPlayerオブジェクトか比較

				$entity->addTitle("Title", "SubTitle", 10, 20, 10);	//$entity(Player)にTitleメッセージの送信

			}
		}
	}


}
