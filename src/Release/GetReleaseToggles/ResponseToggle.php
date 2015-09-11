<?php
namespace Clearbooks\Labs\Release\GetReleaseToggles;

class ResponseToggle
{
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    private $url;

    /**
     * @param $id
     * @param string $name
     * @param $description
     */
    public function __construct( $id, $name, $description, $url )
    {
        $this->name = $name;
        $this->id = $id;
        $this->description = $description;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function getUrl()
    {
        return $this->url;
    }
}