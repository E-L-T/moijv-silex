<?php

namespace Entity;

/**
 * Description of Category
 *
 * @author Etudiant
 */
class Category
{

    /**
     * id of the category
     * @var type 
     */
    private $id;

    /**
     * name of the category
     * @var type 
     */
    private $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId(type $id)
    {
        $this->id = $id;
    }

    public function setName(type $name)
    {
        $this->name = $name;
    }

}
