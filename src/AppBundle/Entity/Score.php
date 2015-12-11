<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table(name="score")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScoreRepository")
 */
class Score
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
     * @var int
     *
     * @ORM\Column(name="score_1", type="smallint")
     */
    private $score1;

    /**
     * @var int
     *
     * @ORM\Column(name="score_2", type="smallint")
     */
    private $score2;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Team")
     * @ORM\JoinColumn(name="country1_id", referencedColumnName="id")
     */
    protected $country1_id;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Team")
     * @ORM\JoinColumn(name="country2_id", referencedColumnName="id")
     */
    protected $country2_id;

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
     * Set score1
     *
     * @param integer $score1
     *
     * @return Score
     */
    public function setScore1($score1)
    {
        $this->score1 = $score1;

        return $this;
    }

    /**
     * Get score1
     *
     * @return int
     */
    public function getScore1()
    {
        return $this->score1;
    }

    /**
     * Set score2
     *
     * @param integer $score2
     *
     * @return Score
     */
    public function setScore2($score2)
    {
        $this->score2 = $score2;

        return $this;
    }

    /**
     * Get score2
     *
     * @return int
     */
    public function getScore2()
    {
        return $this->score2;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->country1_id = new \Doctrine\Common\Collections\ArrayCollection();
        $this->country2_id = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add country1Id
     *
     * @param \AppBundle\Entity\Team $country1Id
     *
     * @return Score
     */
    public function addCountry1Id(\AppBundle\Entity\Team $country1Id)
    {
        $this->country1_id[] = $country1Id;

        return $this;
    }

    /**
     * Remove country1Id
     *
     * @param \AppBundle\Entity\Team $country1Id
     */
    public function removeCountry1Id(\AppBundle\Entity\Team $country1Id)
    {
        $this->country1_id->removeElement($country1Id);
    }

    /**
     * Get country1Id
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountry1Id()
    {
        return $this->country1_id;
    }

    /**
     * Add country2Id
     *
     * @param \AppBundle\Entity\Team $country2Id
     *
     * @return Score
     */
    public function addCountry2Id(\AppBundle\Entity\Team $country2Id)
    {
        $this->country2_id[] = $country2Id;

        return $this;
    }

    /**
     * Remove country2Id
     *
     * @param \AppBundle\Entity\Team $country2Id
     */
    public function removeCountry2Id(\AppBundle\Entity\Team $country2Id)
    {
        $this->country2_id->removeElement($country2Id);
    }

    /**
     * Get country2Id
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountry2Id()
    {
        return $this->country2_id;
    }
}
