<?php

namespace BeeAZZ\SeasonSystem;

use pocketmine\Server;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\plugin\PluginBase;

use pocketmine\event\player\PlayerJoinEvent;


class Season extends PluginBase implements Listener {
  
    protected $season = "";
    
    public const VERSION = 1;
    
    public function onEnable(): void{
     
     $this->getServer()->getPluginManager()->registerEvents($this, $this);
     $this->saveDefaultConfig();
       if($this->getConfig()->get("version") !== self::VERSION){
     $this->getLogger()->notice("§c§lInvalid Plugin Version Please Use Latest Config Version");
     $this->getServer()->getPluginManager()->disablePlugin($this);
     }
    }
    
    public function getSeason(){
     date_default_timezone_set($this->getConfig()->get("date_default_timezone_set"));
     $day = date("d");
        if($day <= 31){
            $season = "Last Winter";
        }
        if($day <= 29){
            $season = "Winter";
        }
        if($day <= 24){
            $season = "Last Autumn";
        }
        if($day <= 22){
            $season = "Autumn";
        }
        if($day <= 14){
            $season = "Last Summer";
        }
        if($day <= 12){
            $season = "Summer";
        }
        if($day <= 7){
            $season = "Last Spring";
        }
        if($day <= 5){
            $season = "Spring";
        }
        return $season;
    }
    
    public function onJoin(PlayerJoinEvent $ev){
     $player = $ev->getPlayer();
     $this->getSeason();
     $player->sendMessage(str_replace("{SEASON}", $this->getSeason(), $this->getConfig()->get("notice")));
    }
}
