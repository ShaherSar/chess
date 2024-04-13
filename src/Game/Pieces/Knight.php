<?php

namespace Shahersar\Chess\Game\Pieces;

class Knight extends PieceAbstract
{
    protected static string $pieceShortcut = 'N';

    public function isValidMoveTo($x, $y, $isAttacking = false): bool
    {
        $isValid = parent::isValidMoveTo($x, $y);

        if (!$isValid) return false;

        $pieceAtXY = $this->board->getPieceAtXY($x, $y);

        if ($pieceAtXY) {
            //handle attack
            return false;
        }

        if ($x == $this->getX() + 1 && ($y == $this->getY() + 2 || $y == $this->getY() - 2)) {
            return true;
        }

        if ($x == $this->getX() - 1 && ($y == $this->getY() + 2 || $y == $this->getY() - 2)) {
            return true;
        }

        if ($x == $this->getX() + 2 && ($y == $this->getY() + 1 || $y == $this->getY() - 1)) {
            return true;
        }

        if ($x == $this->getX() - 2 && ($y == $this->getY() + 1 || $y == $this->getY() - 1)) {
            return true;
        }

        return false;
    }
}