<?php
require_once('../files/config.php');
$mysqli = Database::GetInstance();

$mysqli->begin_transaction();

try {

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && Functions::IsLoggedIn()) {
		$player = Functions::GetPlayer();

		$equipment = $mysqli->query("SELECT * FROM player_equipment WHERE userId = {$player['userId']}")->fetch_assoc();
		$currentShip = $mysqli->query("SELECT * FROM server_ships WHERE shipID = {$player['shipId']}")->fetch_assoc();
		$notOnlineOrOnlineAndInEquipZone = !Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) && Socket::Get('IsInEquipZone', array('UserId' => $player['userId'], 'Return' => false)));

		$lf4Count = json_decode($equipment['items'])->lf4Count;
		$havocCount = json_decode($equipment['items'])->havocCount;
		$herculesCount = json_decode($equipment['items'])->herculesCount;
		$apis = json_decode($equipment['items'])->apis;
		$zeus = json_decode($equipment['items'])->zeus;

		$items = [];
		$drones = [];
		$lf3s = [];
		$lf4s = [];
		$bo2s = [];
		$g3ns = [];
		$havocs = [];
		$herculess = [];

		/*
		$goliathDesigns = [10, 53, 56, 57, 59, 61, 62, 63, 64, 65, 66, 67, 68, 86, 87, 88, 109, 110, 140, 141, 142, 153, 155, 483, 484, 485, 486, 487, 488, 489, 490, 491, 492, 493, 494, 495];
		$vengeanceDesigns = [8, 16, 17, 18, 58, 60];
		$aegisDesigns = [49, 157, 158, 475, 476, 477, 478, 479];
		$spearheadDesigns = [70, 161, 162];
		$citadelDesigns = [69, 159, 160];
		$surgeonDesigns = [156, 473, 474];
		$gchampionDesigns = [445, 446, 447, 448, 449, 450, 451, 452, 453, 454, 455, 456, 457, 458, 459, 460, 461, 462, 463, 464, 465, 466, 467, 468, 469, 470, 471, 472];
		$cyborgDesigns = [480, 481, 482]
		$pusatDesigns = [81, ]
		*/

		CreateDrone(2, 0, 8); //iris
		if ($apis) { CreateDrone(3, 8, 1); } //Apis
		if ($zeus) { CreateDrone(4, $apis ? 9 : 8, 1); }//Zeus

		CreateItem(7, 0, 40); //lf-3
		CreateItem(0, 40, 60); //bo-2
		CreateItem(1, 100, 20); //g3n
		CreateItem(5, 120, $havocCount); //havoc
		CreateItem(6, 130, $herculesCount); //hercules
		CreateItem(8, 140, $lf4Count); //lf-4

		$error = [
			0 => "You can't sell your stuff!",
			1 => "You can't sell your ship!",
			2 => "You can't sell your drones!",
			3 => "Equipping isn't possible. You must be at a location with a hangar facility!",
			4 => 'Something went wrong.',
			5 => 'You cannot change spaceships until the 5 second cool-down has been completed.'
		];

		if (!empty($_POST))
		{
			if($_POST['action'] == 'init')
			{
				if(!empty($_POST['params']))
				{
					$decoded = base64_decode($_POST['params']);
					$json_array = json_decode($decoded, true);

					if($json_array['nr'] == 1)
					{
						$json = '{
							"isError": 0,
							"data": {
							"ret": {
								"filters": {
								"weapons": [
									0,
									1,
									2
								],
								"generators": [
									3,
									4,
									5
								],
								"drone_related": [
									16,
									17
								],
								"ammunition":[
									12,
									13,
									14
								]
								},
								"hangars": [
								{
									"hangarID": "'.$player['userId'].'",
									"name": "",
									"hangar_is_active": true,
									"hangar_is_selected": true,
									"general": {
									"ship": {
										"L": '.$currentShip['id'].',
										"SM": "'.GetCurrentShipLootId().'",
										"M": [
										'.GetDesignsLootIds().'
										]
									},
									"drones": '.json_encode($drones).'
									},
									"config": {
									"1": {
										"ship": {
										"EQ": {
											"lasers": '.$equipment['config1_lasers'].',
											"generators": '.$equipment['config1_generators'].',
											"extras": [

											]
										}
										},
										"drones": {
										'.GetConfigDrones(1).'
										}
									},
									"2": {
										"ship": {
										"EQ": {
											"lasers": '.$equipment['config2_lasers'].',
											"generators": '.$equipment['config2_generators'].',
											"extras": [

											]
										}
										},
										"drones": {
										'.GetConfigDrones(2).'
										}
									}
									}
								}
								],
								"items": '.json_encode($items).',
								"itemInfo": [
									{
										"L": 0,
										"name": "SG3N-BO2",
										"T": 4,
										"C": "generator",
										"levels": [
											'.GetCurrentItemLevelsInformation().'
										]
									},
									{
										"L": 1,
										"name": "G3N-7900",
										"T": 3,
										"C": "generator",
										"levels": [
											'.GetCurrentItemLevelsInformation().'
										]
									},
									{
										"L": 2,
										"name": "Iris",
										"T": 24,
										"C": "drone",
										"repair": 500,
										"currency": "uridium",
										"levels": [
										'.GetDroneLevelsInformation().'
										]
									},
									{
										"L": 3,
										"name": "Apis",
										"T": 24,
										"C": "drone",
										"repair": 500,
										"currency": "uridium",
										"levels": [
										'.GetDroneLevelsInformation().'
										]
									},
									{
										"L": 4,
										"name": "Zeus",
										"T": 24,
										"C": "drone",
										"repair": 500,
										"currency": "uridium",
										"levels": [
										'.GetDroneLevelsInformation().'
										]
									},
									{
										"L": 5,
										"name": "Havoc",
										"T": 16,
										"C": "ship",
										"levels": [
											'.GetCurrentItemLevelsInformation().'
										]
									},
									{
										"L": 6,
										"name": "Hercules",
										"T": 16,
										"C": "ship",
										"levels": [
											'.GetCurrentItemLevelsInformation().'
										]
									},
									{
										"L": 7,
										"name": "LF-3",
										"T": 0,
										"C": "laser",
										"levels": [
											'.GetCurrentItemLevelsInformation().'
										]
									},
									{
										"L": 8,
										"name": "LF-4",
										"T": 0,
										"C": "laser",
										"levels": [
											'.GetCurrentItemLevelsInformation().'
										]
									},
									'.GetShipInformation(9, 49).',
									'.GetShipInformation(10, 49).',
									'.GetShipInformation(11, 49).',
									'.GetShipInformation(12, 69).',
									'.GetShipInformation(13, 69).',
									'.GetShipInformation(14, 69).',
									'.GetShipInformation(15, 70).',
									'.GetShipInformation(16, 70).',
									'.GetShipInformation(17, 70).',
									'.GetAllShipInformations().'
								],
								"userInfo": {
								"factionRelated": "mmo"
								}
							},
							"money": {
								"uridium": "0",
								"credits": "0"
							},
							"map": {
								"types": [
								"Weapon_LaserType",
								"Weapon_HellstormLauncherType",
								"Weapon_WeaponType",
								"Generator_EngineType",
								"Generator_ShieldType",
								"Generator_GeneratorType",
								"Extra_BoosterType",
								"Extra_Cpu_CPUType",
								"Extra_ModuleType",
								"Extra_RobotType",
								"Extra_UpgradeType",
								"Extra_ExtraType",
								"Weapon_Ammo_LaserType",
								"Weapon_Ammo_RocketType",
								"Weapon_Ammo_AmmunitionType",
								"Resource_OreType",
								"Drone_Design_DroneDesignType",
								"Drone_Formation_DroneFormationType",
								"Module_StationModuleType",
								"Pet_PetGearType",
								"Pet_AIProtocolType",
								"Ship_ShipType",
								"Item_ItemType"
								],
								"lootIds": [
								"equipment_generator_shield_sg3n-b02",
								"equipment_generator_speed_g3n-7900",
								"drone_iris",
								"drone_apis",
								"drone_zeus",
								"drone_designs_havoc",
								"drone_designs_hercules",
								"equipment_weapon_laser_lf-3",
								"equipment_weapon_laser_lf-4",
								"ship_aegis-mmo",
								"ship_aegis-eic",
								"ship_aegis-vru",
								"ship_citadel-mmo",
								"ship_citadel-eic",
								"ship_citadel-vru",
								"ship_spearhead-mmo",
								"ship_spearhead-eic",
								"ship_spearhead-vru",
								'.GetAllShipLootIds().'
								]
							}
							}
						}';

						$json = preg_replace('/(\v|\s)+/', '', $json);
						echo base64_encode($json);
					}
				}
			}
			else if($_POST['action'] == 'sell')
			{
				SendError($error[0]);
			}
			else if($_POST['action'] == 'sellShip')
			{
				SendError($error[1]);
			}
			else if($_POST['action'] == 'sellDrone')
			{
				SendError($error[2]);
			}
			else if($_POST['action'] == 'changeShipModel') {
				$decoded = base64_decode($_POST['params']);
				$json_array = json_decode($decoded, true);

				switch ($json_array['lootId']) {
					case 'ship_aegis-mmo':
					case 'ship_aegis-eic':
					case 'ship_aegis-vru':
						$json_array['lootId'] = 'ship_aegis';
						break;
					case 'ship_citadel-mmo':
					case 'ship_citadel-eic':
					case 'ship_citadel-vru':
						$json_array['lootId'] = 'ship_citadel';
						break;
					case 'ship_spearhead-mmo':
					case 'ship_spearhead-eic':
					case 'ship_spearhead-vru':
						$json_array['lootId'] = 'ship_spearhead';
						break;
				}

				$ship = $mysqli->query('SELECT * FROM server_ships WHERE lootID = "'.$json_array['lootId'].'"')->fetch_assoc();

				if ($ship['baseShipId'] == $currentShip['baseShipId']) {
					if ($notOnlineOrOnlineAndInEquipZone) {
						if (!Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) && Socket::Get('AvailableToChangeShip', array('UserId' => $player['userId'], 'Return' => false)))) {
							$mysqli->query('UPDATE player_accounts SET shipId = '.$ship['shipID'].' WHERE userID = '.$player['userId'].'');

							echo base64_encode('{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}');

							if (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
								Socket::Send('ChangeShip', array('UserId' => $player['userId'], 'ShipId' => $ship['shipID']));
							}
						} else {
							SendError($error[5]);
						}
					} else {
						SendError($error[3]);
					}
				} else {
					SendError($error[4]);
				}
			}
			else if($_POST['action'] == 'clearConfig') {
				if ($notOnlineOrOnlineAndInEquipZone) {
					$decoded = base64_decode($_POST['params']);
					$json_array = json_decode($decoded, true);

					$drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]}]';
					$mysqli->query("UPDATE player_equipment SET config".$json_array['configID']."_lasers = '[]', config".$json_array['configID']."_generators = '[]', config".$json_array['configID']."_drones = '".$drones."' WHERE userId = ".$player['userId']."");

					if (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
						Socket::Send('UpdateStatus', array('UserId' => $player['userId']));
					}

					echo base64_encode('{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}');
				} else {
					SendError($error[3]);
				}
			}
			else if ($_POST['action'] == "droneEquip")
			{
				if ($notOnlineOrOnlineAndInEquipZone) {
					$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
					$decoded = base64_decode($_POST['params']);
					$json_array = json_decode($decoded, true);

					$toType = 'config'.$json_array['to']['configId'].'_drones';
					$array = json_decode($mysqli->query('SELECT '.$toType.' FROM player_equipment WHERE userId = '.$player['userId'].'')->fetch_assoc()[$toType]);
					$max_item = 2;

					if (count($array[0]->items) >= $max_item || count($array[count($array) - 1]->items) >= $max_item) {
						for ($i = 0; $i <= count($array) - 1; $i++) {
							if (isset($json_array['from']['droneItems'][$i])) {
								if (count($json_array['from']['droneItems']["$i"]) == $max_item) {
									$array[$i]->items[0] = $json_array['from']['droneItems']["$i"][0];
									$array[$i]->items[1] = $json_array['from']['droneItems']["$i"][1];
								} else if (count($json_array['from']['droneItems']["$i"]) == 1) {
									if (in_array($json_array['from']['droneItems']["$i"][0], $havocs) || in_array($json_array['from']['droneItems']["$i"][0], $herculess)) {
										$array[$i]->designs[0] = $json_array['from']['droneItems']["$i"][0];
									} else {
										$array[$i]->items[(isset($array[$i]->items[0]) ? 1 : 0)] = $json_array['from']['droneItems']["$i"][0];
									}
								}
							}
						}
					} else {
						foreach($json_array['from']['droneItems'] as $key => $item) {
							foreach($item as $slots) {
								if (in_array($slots, $havocs) || in_array($slots, $herculess)) {
									$i = 0;
									if ($i < 1) {
										$array[$key]->designs[] = $slots;
										$i++;
									}
								} else {
									$i = 0;
									if ($i < $max_item) {
										$array[$key]->items[] = $slots;
										$i++;
									}
								}
							}
						}
					}

					$array = array_values($array);
					$json = json_encode($array, JSON_UNESCAPED_UNICODE);
					$mysqli->query("UPDATE player_equipment SET ".$toType." = '".$json."' WHERE userId = ".$player['userId']."");

					echo base64_encode($data);

					if (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
						Socket::Send('UpdateStatus', array('UserId' => $player['userId']));
					}
				} else {
					SendError($error[3]);
				}
			}
			else if($_POST['action'] == 'move') {
				if ($notOnlineOrOnlineAndInEquipZone) {
					$ret = '';
					$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
					$decoded = base64_decode($_POST['params']);
					$json_array = json_decode($decoded, true);
					$itemsCount = array_keys($json_array['from']['items']);
					$last_key = end($itemsCount);
					if ($json_array['from']['target'] == 'inventory' && $json_array['to']['target'] == 'inventory') {
						foreach($json_array['from']['items'] as $key => $item)
						{
							$ret .= '"'.$item.'"' . ($key != $last_key ? "," : "");
							$data = '{"isError":0,"data":{"ret":['.$ret.'],"money":{"uridium":"0","credits":"0"}}}';
						}
					}

					if ($json_array['from']['target'] == 'ship' && $json_array['to']['target'] == 'inventory') {
						$toType = 'config'.$json_array['to']['configId'].'_'.$json_array['from']['slotset'].'';
						$array = json_decode($mysqli->query('SELECT '.$toType.' FROM player_equipment WHERE userId = '.$player['userId'].'')->fetch_assoc()[$toType]);

						foreach($json_array['from']['items'] as $key => $item)
						{
							$index = array_search($item, $array);
							if (in_array($item, $array)) {
								unset($array[$index]);
							}
						}

						$array = array_values($array);
						$json = json_encode($array, JSON_UNESCAPED_UNICODE);
						$mysqli->query("UPDATE player_equipment SET ".$toType." = '".$json."' WHERE userId = ".$player['userId']."");
						$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
					}

					if ($json_array['from']['target'] == 'inventory' && $json_array['to']['target'] == 'ship' && substr($json_array['to']['slotset'], 0, -1) != null) {

						$toType = 'config'.$json_array['to']['configId'].'_'.$json_array['to']['slotset'].'';
						$array = json_decode($mysqli->query('SELECT '.$toType.' FROM player_equipment WHERE userId = '.$player['userId'].'')->fetch_assoc()[$toType]);
						$i = count($array);
						$max_item = $currentShip[$json_array['to']['slotset']];

						foreach($json_array['from']['items'] as $key => $item)
						{
							if ($i == $max_item) {
								$ret .= '"'.$item.'"' . ($key != $last_key ? "," : "");
								$data = '{"isError":0,"data":{"ret":['.$ret.'],"money":{"uridium":"0","credits":"0"}}}';
							}

							if ($i < $max_item) {
								if (($json_array['to']['slotset'] == 'lasers' && (in_array($item, $lf3s) || in_array($item, $lf4s))) ||
								$json_array['to']['slotset'] == 'generators' && (in_array($item, $bo2s) || in_array($item, $g3ns))) {
									array_push($array, $item);
								}

								$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
								$i++;
							}
						}

						$array = array_values($array);
						$json = json_encode($array);
						$mysqli->query("UPDATE player_equipment SET ".$toType." = '".$json."' WHERE userId = ".$player['userId']."");
					}

					if ($json_array['from']['target'] == 'drone' && $json_array['to']['target'] == 'inventory') {
						$toType = 'config'.$json_array['to']['configId'].'_drones';
						$array = json_decode($mysqli->query('SELECT '.$toType.' FROM player_equipment WHERE userId = '.$player['userId'].'')->fetch_assoc()[$toType]);

						foreach($json_array['from']['items'] as $key => $item)
						{
							if (in_array($item, $havocs) || in_array($item, $herculess)) {
								$index = array_search($item, $array[$json_array['from']['droneId']]->designs);
								if (in_array($item, $array[$json_array['from']['droneId']]->designs)) {
									array_splice($array[$json_array['from']['droneId']]->designs, $index, 1);
								}
							} else {
								$index = array_search($item, $array[$json_array['from']['droneId']]->items);
								if (in_array($item, $array[$json_array['from']['droneId']]->items)) {
									array_splice($array[$json_array['from']['droneId']]->items, $index, 1);
								}
							}
						}

						$array = array_values($array);
						$json = json_encode($array, JSON_UNESCAPED_UNICODE);
						$mysqli->query("UPDATE player_equipment SET ".$toType." = '".$json."' WHERE userId = ".$player['userId']."");
						$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
					}

					if ($json_array['from']['target'] == 'inventory' && $json_array['to']['target'] == 'drone' && substr($json_array['to']['slotset'], 0, -1) != null)
					{
						$toType = 'config'.$json_array['to']['configId'].'_drones';

						$array = json_decode($mysqli->query('SELECT '.$toType.' FROM player_equipment WHERE userId = '.$player['userId'].'')->fetch_assoc()[$toType]);
						$i = count($array[$json_array['to']['droneId']]->items);
						$max_item = 2;

						foreach($json_array['from']['items'] as $key => $item) {

							if (in_array($item, $havocs) || in_array($item, $herculess)) {
								if (count($array[$json_array['to']['droneId']]->designs) < 1) {
									array_push($array[$json_array['to']['droneId']]->designs, $item);
									$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
								} else {
									$ret .= '"'.$item.'"' . ($key != $last_key ? "," : "");
									$data = '{"isError":0,"data":{"ret":['.$ret.'],"money":{"uridium":"0","credits":"0"}}}';
								}
							} else {
								if ($i == $max_item) {
									$ret .= '"'.$item.'"' . ($key != $last_key ? "," : "");
									$data = '{"isError":0,"data":{"ret":['.$ret.'],"money":{"uridium":"0","credits":"0"}}}';
								}

								if ($i < $max_item) {
									array_push($array[$json_array['to']['droneId']]->items, $item);
									$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
									$i++;
								}
							}
						}

						$array = array_values($array);
						$json = json_encode($array, JSON_UNESCAPED_UNICODE);
						$mysqli->query("UPDATE player_equipment SET ".$toType." = '".$json."' WHERE userId = ".$player['userId']."");
					}

					echo base64_encode($data);

					if (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
						Socket::Send('UpdateStatus', array('UserId' => $player['userId']));
					}
				} else {
					SendError($error[3]);
				}
			} else {
				SendError($error[3]);
			}
		} else {
			SendError($error[3]);
		}
	} else {
		require(EXTERNALS . 'error.php');
	}

	$mysqli->commit();
} catch (Exception $e) {
	$json['message'] = 'An error occurred. Please try again later.';
	$mysqli->rollback();
}

$mysqli->close();

function SendError($errorMessage) {
	echo base64_encode('{"isError":1,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}},"error":{"message":"'.$errorMessage.'"}}');
}

function GetCurrentItemLevelsInformation()
{
	return '
	{
		"selling": {
		"credits": 0
		},
		"cdn": {
		"30x30": "ea805e03b2d3fa173b723f1f846bc900",
		"63x63": "768dea8b4af9ee7381b707cc63f3ac00",
		"100x100": "6f332bdc590ad65c8095d1c303cebf00"
		}
	}';
}

function GetDroneLevelsInformation($amount = 8)
{
	$json = '';
	for($i = 0; $i <= $amount; $i++){
		$json .= '{
							  "slotsets": {
								"default": {
								  "T": [
									0,
									4,
									11,
									9,
									7,
									8,
									10
								  ],
								  "Q": 2
								},
								"design": {
								  "T": [
										16
								  ],
								  "Q": 1
								}
							  },
							  "selling": {
								"credits": 0
							  },
							  "cdn": {
								"30x30": "40860d1594e9b6841ccfa87963f8d800",
								"63x63": "0cd363e0f68297796aeb1a1dc8725500",
								"100x100": "915c51fde19ca5d0c4878221ae305f00",
								"top": "b6aae2912b6e0eb1b49d50ab5caef400"
							  }
							}' . ($i != $amount ? "," : "");
	}
	return $json;
}

function CreateItem($item_id, $fromId, $amount)
{
  global $items, $drones, $bo2s, $g3ns, $lf3s, $lf4s, $havocs, $herculess;

	if ($item_id == 6 || $item_id == 8) {
		$amount = $fromId + $amount;
	} else {
		$amount = count($items) + $amount;
	}

	for($i = $fromId; $i < $amount; $i++) {

		$item = array("I" => $i, "LV" => 0, "L" => $item_id, "S" => $i);
		array_push($items, $item);

		switch ($item_id) {
			case 0:
				$bo2s[] = $i;
				break;
			case 1:
				$g3ns[] = $i;
				break;
			case 5:
				$havocs[] = $i;
				break;
			case 6:
				$herculess[] = $i;
				break;
			case 7:
				$lf3s[] = $i;
				break;
			case 8:
				$lf4s[] = $i;
				break;
		}
	}
}

function CreateDrone($item_id, $fromId, $amount)
{
  global $drones;

  $amount = count($drones) + $amount;
	for($i = $fromId; $i < $amount; $i++) {
		$drone = ["I" => $i, "L" => $item_id, "LV" => 5, "HP" => "0%",
		"EF" => "10%/20%", "SP" => 15625, "DE" => "", "DL" => null, "SL" => null, "repair" => 500, "currency" => "uridium"];

		array_push($drones, $drone);
	}
}

function GetDesignsLootIds()
{
	global $mysqli, $equipment, $currentShip;

	$ships = [$mysqli->query('SELECT lootID FROM server_ships WHERE shipID = '.$currentShip['baseShipId'].'')->fetch_assoc()['lootID']];

	if ($currentShip['baseShipId'] == 8) {
		$currentDesigns = [
		'ship_vengeance_design_adept',
		'ship_vengeance_design_corsair',
		'ship_vengeance_design_avenger',
		'ship_vengeance_design_revenge',
		'ship_vengeance_design_lightning'];
		$ships = array_merge($ships, $currentDesigns);
	} else if ($currentShip['baseShipId'] == 10) {
		$currentDesigns = [
		'ship_goliath_design_solace',
		'ship_goliath_design_diminisher',
		'ship_goliath_design_spectrum',
		'ship_goliath_design_sentinel',
		'ship_goliath_design_venom',
		'ship_goliath_design_enforcer',
		'ship_goliath_design_bastion',
		'ship_goliath_design_veteran',
		'ship_goliath_design_exalted',
		'ship_goliath_design_crimson',
		'ship_goliath_design_ignite',
		'ship_goliath_design_centaur',
		'ship_goliath_design_goliath-razer'];
		$ships = array_merge($ships, $currentDesigns);
	}

	$designs =json_decode($equipment['items'])->designs;

	if (property_exists($designs, $currentShip['baseShipId']))
	{
		foreach ($designs->{$currentShip['baseShipId']} as $ship) {
			$lootId = $mysqli->query('SELECT lootID FROM server_ships WHERE shipID = '.$ship.'')->fetch_assoc()['lootID'];
			array_push($ships, $lootId);
		}
	}

	return str_replace(str_split('[]'), '', json_encode($ships));
}

function GetConfigDrones($configId)
{
	global $mysqli, $apis, $zeus, $player;

	$drones = '';
	$target = 'config' .$configId. '_drones';
	$array = json_decode($mysqli->query('SELECT '.$target.' FROM player_equipment WHERE userId = '.$player['userId'].'')->fetch_assoc()[$target]);
	if (!$apis) array_pop($array);
	if (!$zeus) array_pop($array);

	foreach($array as $key => $item)
	{
			$drones .= '"'.$key.'": {
											"EQ": {
												"default": '.json_encode($item->items).',
												"design": '.json_encode($item->designs).'
											}
										}' . ($key != count($array) - 1 ? "," : "");
	}

	return $drones;
}

function GetCurrentShipLootId()
{
	global $mysqli, $player;

	$lootId = $mysqli->query('SELECT lootID FROM server_ships WHERE shipID = '.$player['shipId'].'')->fetch_assoc()['lootID'];

	if ($lootId == 'ship_aegis' || $lootId == 'ship_citadel' || $lootId == 'ship_spearhead') {
		$lootId .= '-';
		$lootId .= $player['factionId'] == 1 ? 'mmo' : ($player['factionId'] == 2 ? 'eic' : 'vru');
	}

	return $lootId;
}

function GetAllShipInformations() {
	global $mysqli;

	$ships = '';

	$array = $mysqli->query('SELECT id, shipID FROM server_ships')->fetch_all(MYSQLI_ASSOC);
	foreach ($array as $key => $ship) {
		$ships .= GetShipInformation($ship['id'], $ship['shipID']) . ($key != count($array) - 1 ? ',' : '');
	}

	return $ships;
}

function GetAllShipLootIds() {
	global $mysqli;

	$lootIds = '';

	$array = $mysqli->query('SELECT lootID FROM server_ships')->fetch_all(MYSQLI_ASSOC);
	foreach ($array as $key => $ship) {
		$lootIds .= '"'.$ship['lootID'].'"'. ($key != count($array) - 1 ? ',' : '');
	}

	return $lootIds;
}

function GetShipInformation($itemId, $shipId) {
	global $mysqli;

	$informations = $mysqli->query('SELECT * FROM server_ships WHERE shipID = '.$shipId.'')->fetch_assoc();

	return json_encode([
		'L' => $itemId,
		'name' => $informations['name'],
		'T' => 22,
		'C' => 'ship',
		'levels' => [
			[
				'slotsets' => [
					'lasers' => [
						'T' => [0],
						'Q' => $informations['lasers']
					],
					'generators' => [
						'T' => [3, 4],
						'Q' =>$informations['generators']
					],
					'heavy_guns' => [
						'T' => [1],
						'Q' => 0
					],
					'extras' => [
						'T' => [6, 7, 8, 10, 11],
						'Q' => 0
					]
				]
			],
			[
				'selling' => [
					'credits' => 0
				]
			],
			[
				'cdn' => [
					'63x63' => 'c6c8a09a4749af691b6a9947cf2c6900',
					'100x100' => '5fcdb83e69b401d92cc1ae6abb172300',
					'top' => 'a604cd4669b80a0ddd89fa54fc946300'
				]
			]
		]
	]);
}
?>
