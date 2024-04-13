<?php

namespace Shahersar\Chess\Game\Pieces;

class Queen extends PieceAbstract
{
    protected static string $pieceShortcut = 'Q';

    public function isValidMoveTo($x, $y, $isAttacking = false): bool
    {

    }
}