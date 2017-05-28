<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * StoreRequest
 *
 * @ORM\Table(name="store_request")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StoreRequestRepository")
 */
class StoreRequest
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="headers", type="text")
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $headers;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     * @Assert\Length(min=0)
     * @Assert\Type("string")
     */
    private $body = null;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $route;

    /**
     * @var string
     *
     * @ORM\Column(name="method", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $method;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     * @Assert\Ip
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     * @Assert\DateTime()
     */
    private $created;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set headers
     *
     * @param string $headers
     *
     * @return StoreRequest
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get headers
     *
     * @return string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return StoreRequest
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return StoreRequest
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return StoreRequest
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return StoreRequest
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return StoreRequest
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}

