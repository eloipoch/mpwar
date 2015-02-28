<?php

namespace MPWAR\Module\Player\Domain;

interface PlayerRepository
{
    /**
     * @param Player $player
     *
     * @return void
     */
    public function add(Player $player);
}
