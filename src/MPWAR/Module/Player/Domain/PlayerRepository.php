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

    /**
     * @param PlayerId $id
     *
     * @return Player|null
     */
    public function search(PlayerId $id);
}
