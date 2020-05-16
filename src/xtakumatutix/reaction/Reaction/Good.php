<?php
namespace xtakumatutix\reaction\Reaction;

use pocketmine\level\Position;

//クラスGoodはReactionを継承(extends)する
class Good extends Reaction
{
    public function __construct(Position $pos)
    {
        //地点, タイトル, テキスト
        parent::__construct($pos, "§l§eGood!!", "いいね！！");
    }
}