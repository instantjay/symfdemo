<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Project
 * @package App\Entities
 * @ORM\Entity()
 * @ORM\Table(name="projects")
 */
class Project
{
    /**
     * @var string
     * @ORM\Column(type="string", name="id")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Closure
     */
    public function getRoundingStrategy()
    {
        return function ($value) {
            return ceil($value);
        };
    }

    /**
     * @var integer
     * @ORM\Column(type="integer", name="preferred_decimals")
     */
    protected $preferredDecimals;

    public function getPreferredDecimals()
    {
        $this->preferredDecimals;
    }
}
