<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Order
 * @package App\Entities
 * @ORM\Entity()
 * @ORM\Table(name="orders")
 */
class Order
{
    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="\App\Entities\OrderItem", mappedBy="order")
     */
    protected $orderItems;

    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * @param OrderItem $item
     */
    public function addOrderItem(OrderItem $item)
    {
        $this->orderItems->add($item);
    }

    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="\App\Entities\Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $project;

    public function getProject()
    {
        return $this->project;
    }

    public function setProject(Project $project)
    {
        $this->project = $project;
    }
}
