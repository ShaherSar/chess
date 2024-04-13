<?php

namespace Shahersar\Chess\Game\Pieces;

use Shahersar\Chess\Game\Board;

abstract class PieceAbstract
{
    protected Board $board;
    protected int $x;
    protected int $y;
    protected int $type;
    const WHITE_TYPE = 0;
    const BLACK_TYPE = 1;
    protected static string $pieceShortcut = '';

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function __construct(Board $board, int $type, int $x, int $y)
    {
        if (static::$pieceShortcut == '') {
            throw new \Exception('shortcut should not be empty');
        }

        $this->board = $board;
        $this->type = $type;
        $this->x = $x;
        $this->y = $y;
    }

    function moveTo($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    function isValidMoveTo($x, $y, $isAttacking = false): bool
    {
        if ($x > $this->board->getMaximumX()) {
            return false;
        }

        if ($y > $this->board->getMaximumY()) {
            return false;
        }

        if ($x < 0 || $y < 0) {
            return false;
        }

        if ($x == $this->getX() && $y == $this->getY()) {
            return false;
        }

        $pieceAtXY = $this->board->getPieceAtXY($x, $y);

        if ($pieceAtXY && $pieceAtXY->getType() == $this->getType()) return false;

        return true;
    }

    public function getPieceTypeString(): string
    {
        if ($this->type == self::WHITE_TYPE) {
            return 'W';
        }

        if ($this->type == self::BLACK_TYPE) {
            return 'B';
        }

        return 'NULL';
    }

    public function getPieceName(): string
    {
        if ($this->type == self::WHITE_TYPE) {
            return strtoupper(static::$pieceShortcut);
        }

        if ($this->type == self::BLACK_TYPE) {
            return strtolower(static::$pieceShortcut);
        }

        return 'NULL';
    }
}