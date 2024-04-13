<?php

namespace Shahersar\Chess\Game\Pieces;

class Rock extends PieceAbstract
{
    protected static string $pieceShortcut = 'R';

    public function isValidMoveTo($x, $y, $isAttacking = false): bool
    {
        $isValid = parent::isValidMoveTo($x, $y);

        if (!$isValid) return false;

        if ($x == $this->getX()) {
            print("move is on Y axis\r\n");
            if ($y > $this->getY()) {
                print("y > this-> y\r\n");
                for ($i = $this->getY() + 1; $i < $y; $i++) {
                    print("loop counter ++\r\n");
                    if ($this->board->getPieceAtXY($this->getX(), $i)) {
                        print("piece found at TO X,Y\r\n");
                        return false;
                    }
                }
            }

            if ($y < $this->getY()) {
                print("y < this-> y\r\n");
                for ($i = $this->getY() - 1; $i > $y; $i--) {
                    print("loop counter --\r\n");
                    if ($this->board->getPieceAtXY($this->getX(), $i)) {
                        print("piece found at TO X,Y\r\n");
                        return false;
                    }
                }
            }

            return true;
        }

        if ($y == $this->getY()) {
            print("move is on X axis\r\n");
            return true;
        }

        return false;
    }
}