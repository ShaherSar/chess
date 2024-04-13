<?php

namespace Shahersar\Chess\Game;

use Shahersar\Chess\Game\Pieces\Bishop;
use Shahersar\Chess\Game\Pieces\King;
use Shahersar\Chess\Game\Pieces\Knight;
use Shahersar\Chess\Game\Pieces\Pawn;
use Shahersar\Chess\Game\Pieces\Queen;
use Shahersar\Chess\Game\Pieces\Rock;

class Game
{
    protected int $currentPlayerToPlayId = 0;
    protected ?Board $board;

    public function __construct()
    {
        $this->board = new Board();
    }

    public function run()
    {
        $pieces = array_merge($this->getWhitePieces($this->board), $this->getBlackPieces($this->board));

        $this->board->addPieces($pieces);

        while (true) {
            print("DRAW || WHO || Move : [1,2]|[1,3]\r\n");

            $line = readline();

            if ($line == 'DRAW') {
                $this->board->print();
                continue;
            }

            if ($line == 'WHO') {
                print("its player " . $this->currentPlayerToPlayId . " turn ..\r\n");
                continue;
            }

            $cells = explode('|', $line);

            $from = $cells[0];

            $fromXYAxis = explode(',', $from);

            $fromX = $fromXYAxis[0];
            $fromY = $fromXYAxis[1];

            $pieceAtFromXY = $this->board->getPieceAtXY($fromX, $fromY);

            if (!$pieceAtFromXY) {
                print("no piece found at [$fromX|$fromY]\r\n");
                continue;
            }

            if ($pieceAtFromXY->getType() != $this->currentPlayerToPlayId) {
                print("this piece is a " . $pieceAtFromXY->getPieceTypeString() . "\r\n");
                continue;
            }

            print("We Found Piece At [$fromX,$fromY] {$pieceAtFromXY->getPieceName()} trying to move it \r\n");

            $to = $cells[1];
            $toXYAxis = explode(',', $to);

            $toX = $toXYAxis[0];
            $toY = $toXYAxis[1];

            if (!$pieceAtFromXY->isValidMoveTo($toX, $toY)) {
                print("error move to $toX,$toY \r\n");
                continue;
            }

            print("correct move\r\n");
            $pieceAtFromXY->moveTo($toX, $toY);
            $this->currentPlayerToPlayId = !$this->currentPlayerToPlayId;
        }
    }

    protected function getWhitePieces(Board $board): array
    {
        return [
            new Rock($board, 0, 0, 0), new Knight($board, 0, 1, 0), new Bishop($board, 0, 2, 0), new Queen($board, 0, 3, 0),
            new King($board, 0, 4, 0), new Bishop($board, 0, 5, 0), new Knight($board, 0, 6, 0), new Rock($board, 0, 7, 0),
            new Pawn($board, 0, 0, 1), new Pawn($board, 0, 1, 1), new Pawn($board, 0, 2, 1), new Pawn($board, 0, 3, 1),
            new Pawn($board, 0, 4, 1), new Pawn($board, 0, 5, 1), new Pawn($board, 0, 6, 1), new Pawn($board, 0, 7, 1),
        ];
    }

    protected function getBlackPieces(Board $board): array
    {
        return [
            new Rock($board, 1, 0, 7), new Knight($board, 1, 1, 7), new Bishop($board, 1, 2, 7), new Queen($board, 1, 3, 7),
            new King($board, 1, 4, 7), new Bishop($board, 1, 5, 7), new Knight($board, 1, 6, 7), new Rock($board, 1, 7, 7),
            new Pawn($board, 1, 0, 6), new Pawn($board, 1, 1, 6), new Pawn($board, 1, 2, 6), new Pawn($board, 1, 3, 6),
            new Pawn($board, 1, 4, 6), new Pawn($board, 1, 5, 6), new Pawn($board, 1, 6, 6), new Pawn($board, 1, 7, 6)
        ];
    }
}