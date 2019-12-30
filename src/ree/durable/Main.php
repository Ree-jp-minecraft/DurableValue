<?php
namespace ree\durable;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\Durable;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

    private const NOTICE = '§a>>§r ';

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this ,$this);
        $this->getLogger()->info(self::NOTICE.'読み込めました');
        $this->getLogger()->info(self::NOTICE.'最新のバージョンはこちらから');
        $this->getLogger()->info(self::NOTICE.'https://github.com/Ree-jp/DurableValue');
        parent::onEnable();
    }

    public function onBreak(BlockBreakEvent $ev)
    {
        $p = $ev->getPlayer();
        $item = $ev->getItem();

        if ($item instanceof Durable)
        {
            $value = $item->getMaxDurability() - $item->getDamage();
            $value--;
            $p->sendTip(self::NOTICE.'残りの耐久値は'.$value.'です');
        }
    }

    public function onDisable()
    {
        parent::onDisable();
    }
}
