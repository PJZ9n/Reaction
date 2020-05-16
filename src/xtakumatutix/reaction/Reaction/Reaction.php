<?php
namespace xtakumatutix\reaction\Reaction;

use pocketmine\level\particle\FloatingTextParticle;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;

/**
 * Class Reaction
 *
 * リアクションはこのクラスを継承(extends)する
 *
 * @package xtakumatutix\reaction\Reaction
 */
abstract class Reaction
{
    /**
     * Playerからリアクションの表示位置を計算して返す
     *
     * @param Player $player
     * @return Position
     */
    public static function calculatePosition(Player $player): Position
    {
        $pos = $player->asPosition();
        $pos = Position::fromObject($pos->add(1, 1.2, 0), $pos->getLevel());//Xに1、Yに1.2、Zに0足す
        return $pos;//計算されたPositionを返す
    }

    /** @var Position */
    private $pos;

    /** @var string */
    private $title;

    /** @var string */
    private $text;

    public function __construct(Position $pos, string $title, string $text)
    {
        $this->pos = $pos;
        $this->title = $title;
        $this->text = $text;
    }

    /**
     * リアクションを表示する
     */
    public function show(): void
    {
        $particle = new FloatingTextParticle($this->pos, $this->text, $this->title);
        $level = $this->pos->getLevel();
        $level->addParticle($particle);

        $task = new ClosureTask(function (int $currentTick) use ($particle, $level): void {
            $particle->setInvisible(true);//パーティクルを見えなくする(これ以外に消す方法あるかも)
            $level->addParticle($particle);//見えなくしたのを反映させる
        });
        $plugin = Server::getInstance()->getPluginManager()->getPlugin("reaction");
        /** @var Plugin $plugin */
        $plugin->getScheduler()->scheduleDelayedTask($task, 20 * 5);//5秒後に実行
    }

    /**
     * @return Position
     */
    public function getPos(): Position
    {
        return $this->pos;
    }

    /**
     * @param Position $pos
     */
    public function setPos(Position $pos): void
    {
        $this->pos = $pos;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }
}