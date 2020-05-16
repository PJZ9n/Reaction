<?php
namespace xtakumatutix\reaction\Reaction;

use pocketmine\level\particle\GenericParticle;
use pocketmine\level\particle\Particle;
use pocketmine\level\Position;

class Excited extends Reaction
{
    public function __construct(Position $pos)
    {
        //地点, タイトル, テキスト
        parent::__construct($pos, "§l§eExcited!!", "ウキウキ！！");
    }

    public function show(): void
    {
        parent::show();
        $pos = $this->getPos();
        $particle = new GenericParticle($pos, Particle::TYPE_NOTE);//音符パーティクル
        $pos->getLevel()->addParticle($particle);
    }
}