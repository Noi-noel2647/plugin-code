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

		$x = (float) 128;		//�����������\������� x���W
		$y = (float) 8;			//�����������\������� y���W
		$z = (float) 128;		//�����������\������� z���W

		$eid = Entity::$entityCount++;	//EntityID (�Œ肪�ǂ�)
		$name = "FloatingText";		//�������� 
		$pos = new Vector3($x, $y, $z);	//vector3 �I�u�W�F�N�g

		$pk = new AddPlayerPacket();

			$pk->uuid = UUID::fromRandom();
			$pk->username = $name;
			$pk->entityUniqueId = $eid;
			$pk->entityRuntimeId = $eid;
			$pk->position = $pos;
			$pk->item = Item::get(Item::AIR);	//��������"�Ȃ�"�Ȃ̂� AIR

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
		$event->getPlayer()->dataPacket($this->FloatInfo);	//Player�Q�����ɕ�������(Packet)�𑗐M

	}

}

