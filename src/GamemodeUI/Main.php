<?php

namespace Sell;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;

use jojoe77777\FormAPI;

Class Main extends PluginBase{
  
  public function onEnable(){
    $this->getLogger()->info("§aEnable §bGamemodeUI...");
  }
  
  public function onCommand(CommandSender $sender, Command $command, String $label, array $args) : bool {
    if($command->getName() === "sellui"){
      if($sender->hasPermission("sellui.cmd")){
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createCustomForm(function(Player $sender, $data){
          $result = $data[0];
          if( !is_null($data)) {
            switch($result) {
            case 0:
              break;
            case 1:
              $sender->sendMessage($this->getConfig()->get("msg-creative"));
              $sender->addTitle("§eSell Hand", "§fSell your hand");
              $sender->sell hand;
              break;
            case 2:
              $sender->sendMessage($this->getConfig()->get("msg-survival"));
              $sender->addTitle("§eSell All", "§fSell all of the chosen block");
              $sender->sell all;
              break;
            case 3:
              $sender->sendMessage($this->getConfig()->get("msg-adventure"));
              $sender->addTitle("§eSell Inv", "§fSell everything");
              $sender->sell inv;
              break;
            case 4:
              $sender->sendMessage($this->getConfig()->get("msg-spectator"));
              $sender->addTitle("§eShop", "§fBuy items");
              $sender->shop;
              default:
                return;
                }
           }
          });
          $form->setTitle($this->getConfig()->get("Title"));
          $form->addDropdown("Menu", ["Exit", "Sell Hand", "Sell all", "sell Inventory", "Shop"]);
          $form->sendToPlayer($sender);
      } else {
        $sender->sendMessage($this->getConfig()->get("msg-no-perm"));
      }
    }
    return true;
  }
}
