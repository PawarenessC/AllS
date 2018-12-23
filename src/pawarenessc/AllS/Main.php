<?php

namespace pawarenessc\AllS;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\Player;

use pocketmine\Server;

use pocketmine\level\Level;

use pocketmine\math\Vector3;

use pocketmine\command\Command;






use pocketmine\command\CommandSender;

use pocketmine\utils\Config;




class Main extends pluginBase implements Listener{

public function onEnable() {



 $this->getLogger()->info("=========================");

 $this->getLogger()->info("AllSを読み込みました");

 $this->getLogger()->info("v0.1");

 $this->getLogger()->info("=========================");

 $this->getScheduler()->scheduleRepeatingTask(new CallbackTask([$this, "survival"]), 10);
 
 $this->config = new Config($this->getDataFolder() . "names.yml", Config::YAML);
 
 $this->getServer()->getPluginManager()->registerEvents($this, $this);
 }
 
 public function onCommand(CommandSender $sender, Command $command, string $label, array $args) :bool{

 switch ($command->getName()){
  case "adds";
  if (empty($args[0])){



                $sender->sendMessage("§b使い方 : /adds <プレイヤーネーム>");



                return true;



            }
  $name = $args[0];
  $sender->sendMessage("{$name} を追加しました。");
  $this->config->set($name);
  $this->config->save();
  
  return true;
 }
}
 
 
 public function survival(){
 foreach(Server::getInstance()->getOnlinePlayers() as $player){
   $name = $player->getName();
   if($player->isOp() or $this->config->exists($name)){
   }else{
   $player->setGamemode(0);
   return true;
   }
  }
 }
}
