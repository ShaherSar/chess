<?php

namespace Shahersar\Chess\Game\Pieces;

class King extends PieceAbstract
{
    protected static string $pieceShortcut = 'K';

    public function isValidMoveTo($x, $y, $isAttacking = false): bool
    {
        $isValid = parent::isValidMoveTo($x, $y);

        if(!$isValid) return false;

        $xStep = abs($this->getX() - $x);
        $yStep = abs($this->getY() - $y);

        if($xStep > 1) return false;

        if($yStep > 1) return false;

        return true;
    }
}