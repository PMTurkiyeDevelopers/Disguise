<?php

namespace Enes5519\Disguise;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as R;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener{

    public $b = R::DARK_GRAY . "» ";
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("\n§6Disguise Plugin by Enes5519\n§fPlugin Status: §aENABLE");
        @mkdir($this->getDataFolder());
        $isimler = new Config($this->getDataFolder() . "isimler.yml", Config::YAML);
        if($isimler->get("Isimler") == null){
            $isimler->set("Isimler", array("Enes5519", "PocketMineTurkiye", "AvesomePlugin"));
            $isimler->save();
        }
    }
    
    public function onCommand(CommandSender $g, Command $kmt, $label, array $args){
        $isimler = new Config($this->getDataFolder() . "isimler.yml", Config::YAML);
        if($kmt->getName() == "disguise"){
            if($g->hasPermission("enes5519.disguise" or $g->isOp())){
                if(!(isset($args[0]))){
                    if($g instanceof Player){
                        $isim = $isimler->get("Isimler");
                        $dsayi = count($isim);
                        $karisik = rand(1,$dsayi);
                        $disguise = $isim[$karisik];
                        if($disguise == null){
                            $g->setDisplayName($isim[1]);
                            $g->setNameTag($g->getDisplayName());
                            $g->sendMessage($this->b . R::YELLOW . "Disguise Name: " . R::AQUA . $g->getDisplayName());
                        }else{
                             $g->setDisplayName($disguise);
                            $g->setNameTag($g->getDisplayName());
                            $g->sendMessage($this->b . R::YELLOW . "Disguise Name: " . R::AQUA . $g->getDisplayName());
                         }
                    }else{
                        $g->sendMessage($this->b . R::RED . "This command works only in the game!");
                    }
                }
            }
        }
    }
}
