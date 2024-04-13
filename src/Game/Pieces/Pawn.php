<?php

namespace Shahersar\Chess\Game\Pieces;

class Pawn extends PieceAbstract
{
    protected bool $hasMoved = false;

    protected static string $pieceShortcut = 'P';

    function isValidMoveTo($x, $y, $isAttacking = false): bool
    {
        $isValidMove = parent::isValidMoveTo($x, $y);

        if(!$isValidMove) return false;

        $yStep = abs($this->getY() - $y);

        if ($yStep == 1) {
            return true;
        }

        if (!$this->hasMoved && $yStep == 2) {
            $this->hasMoved = true;
            return true;
        }

        return false;
    }
}