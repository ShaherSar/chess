<?php

namespace Shahersar\Chess\Game;

use Shahersar\Chess\Game\Pieces\PieceAbstract;

class Board
{
    protected array $pieces;
    protected int $maximumX;
    protected int $maximumY;

    public function __construct(array $pieces = [], int $maximumX = 7, int $maximumY = 7)
    {
        $this->pieces = $pieces;
        $this->maximumX = $maximumX;
        $this->maximumY = $maximumY;
    }

    public function addPieces(array $pieces): void
    {
        foreach ($pieces as $piece) {
            $this->addPiece($piece);
        }
    }

    public function addPiece(PieceAbstract $piece): void
    {
        $this->pieces[] = $piece;
    }

    public function getMaximumX(): int
    {
        return $this->maximumX;
    }

    public function getMaximumY(): int
    {
        return $this->maximumY;
    }

    public function getPieceAtXY($x, $y): ?PieceAbstract
    {
        foreach ($this->pieces as $piece) {
            if ($piece->getX() == $x && $piece->getY() == $y) return $piece;
        }

        return null;
    }

    public function print()
    {
        print("----------------------------");
        print("\r\n\r\n");

        $board = [];

        for($x = 0; $x <= $this->getMaximumX(); $x++){
            for($y = 0; $y <= $this->getMaximumY(); $y++){
                if(!isset($board[$x])) $board[$x] = [];
                $board[$x][$y] = '.';
            }
        }

        foreach ($this->pieces as $piece) {
            if ($piece instanceof PieceAbstract) {
                $board[$piece->getY()][$piece->getX()] = $piece->getPieceName();
            }
        }

        print("  0 1 2 3 4 5 6 7\n");

        foreach ($board as $key => $boardRow) {
            print($key . ' ');
            foreach ($boardRow as $boardColumn) {
                print($boardColumn . " ");
            }

            print("\r\n");
        }

        print("----------------------------\r\n");
    }
}