<?php
namespace xtakumatutix\reaction\Form;

use pocketmine\form\Form;
use pocketmine\Player;
use xtakumatutix\reaction\Reaction\Excited;
use xtakumatutix\reaction\Reaction\Good;
use xtakumatutix\reaction\Reaction\Reaction;

class ActionForm implements Form
{
    public function handleResponse(Player $player, $data): void
    {
        if ($data === null) {
            return;
        }

        switch ($data) {
            case 0:
                $pos = Reaction::calculatePosition($player);//地点をプレイヤーの場所から計算する
                $good = new Good($pos);//Goodクラスを作成
                $good->show();//表示させる
                break;
            case 1:
                $excited = new Excited(Reaction::calculatePosition($player));
                $excited->show();
                break;
        }
    }

    public function jsonSerialize()
    {
        return [
            'type' => 'form',
            'title' => 'リアクション',
            'content' => 'ボタンを押してリアクションしましょう',
            'buttons' => [
                [
                    'text' => 'Good',
                ],
                [
                    'text' => 'Excited',
                ]
            ],
        ];
    }
}