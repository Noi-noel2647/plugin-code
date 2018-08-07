<?php



use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use pocketmine\entity\Entity;
use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\utils\UUID;
use pocketmine\network\mcpe\protocol\AddPlayerPacket;

use pocketmine\event\player\PlayerJoinEvent;


class FloatingText extends PluginBase implements Listener {

	public function onEnable(){

		$x = (float) 128;		//浮き文字が表示される x座標
		$y = (float) 8;			//浮き文字が表示される y座標
		$z = (float) 128;		//浮き文字が表示される z座標

		$eid = Entity::$entityCount++;	//EntityID (固定が良い)
		$name = "FloatingText";		//浮き文字 
		$pos = new Vector3($x, $y, $z);	//vector3 オブジェクト

		$pk = new AddPlayerPacket();

			$pk->uuid = UUID::fromRandom();
			$pk->username = $name;
			$pk->entityUniqueId = $eid;
			$pk->entityRuntimeId = $eid;
			$pk->position = $pos;
			$pk->item = Item::get(Item::AIR);	//持ち物は"なし"なので AIR

			$flags =
				 1 << Entity::DATA_FLAG_CAN_SHOW_NAMETAG |
				 1 << Entity::DATA_FLAG_ALWAYS_SHOW_NAMETAG |
				 1 << Entity::DATA_FLAG_IMMOBILE;

				$pk->metadata = [
							Entity::DATA_FLAGS => [Entity::DATA_TYPE_LONG, $flags],
							Entity::DATA_SCALE => [Entity::DATA_TYPE_FLOAT, 0],
						];

			$this->FloatInfo = $pk;

	}


	public function onJoin(PlayerJoinEvent $event){
		$event->getPlayer()->dataPacket($this->FloatInfo);	//Player参加時に浮き文字(Packet)を送信

	}

}

