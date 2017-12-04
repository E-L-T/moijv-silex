<?php

namespace Entity;

/**
 * Description of Loaning
 *
 * @author eric
 */
class Loaning
{

    /**
     * id of the Loaning
     * @var int
     */
    private $id;

    /**
     * date start of the loaning
     * @var \Datetime
     */
    private $dateStart;

    /**
     * date end of the loaning
     * @var \Datetime
     */
    private $dateEnd;

    /**
     * the game associated with this loaning
     * @var \Entity\Game
     */
    private $game;

    /**
     * the user that did this loaning
     * @var \Entity\User
     */
    private $user;

    public function getId()
    {
        return $this->id;
    }

    public function getDateStart()
    {
        return $this->dateStart;
    }

    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function getGame()
    {
        return $this->game;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDateStart($dateStart)
    {
        if ($dateStart instanceof string) {
            $dateStart = \Datetime::createFromFormat('Y/m/d', $dateStart);
        }
        $this->dateStart = $dateStart;
    }

    public function setDateEnd($dateEnd)
    {
        if ($dateEnd instanceof string) {
            $dateEnd = \Datetime::createFromFormat('Y/m/d', $dateEnd);
        }
        $this->dateEnd = $dateEnd;
    }

    public function setGame(\Entity\Game $game)
    {
        $this->game = $game;
    }

    public function setUser(\Entity\User $user)
    {
        $this->user = $user;
    }

}
