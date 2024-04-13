<?php

namespace Shahersar\Chess\Game\Pieces;

class Bishop extends PieceAbstract
{
    protected static string $pieceShortcut = 'B';

    public function isValidMoveTo($x, $y, $isAttacking = false): bool
    {
        $isValid = parent::isValidMoveTo($x, $y);

        if(!$isValid) return false;

        if(abs($this->getX() - $x) != abs($this->getY() - $y)) return false;

        $xStep = $x > $this->getX() ? 1 : -1;
        $yStep = $y > $this->getY() ? 1 : -1;

        $xOnWay = $this->x + $xStep;
        $yOnWay= $this->y + $yStep;

        while ($xOnWay != $x && $yOnWay != $y) {
            if ($this->board->getPieceAtXY($xOnWay, $yOnWay) !== null) {
                return false;
            }
            $xOnWay += $xStep;
            $xOnWay += $yStep;
        }

        return true;
    }
}