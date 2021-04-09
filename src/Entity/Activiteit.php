<?php

namespace App\Entity;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Activiteit
 *
 * @ORM\Table(name="activiteiten")
 * @ORM\Entity(repositoryClass="App\Repository\ActiviteitRepository")
 */
class Activiteit
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
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date")
     * @Assert\NotBlank(message="vul een datum in")
     *
     */
    private $datum;

    /**
     * @Assert\Time
     * @ORM\Column(name="tijd", type="time")
     * @var string A "H:i" formatted value
     * @Assert\NotBlank(message="vul een tijd in")
     */
    private $tijd;

    /**
     * @ORM\ManyToOne(targetEntity="Soortactiviteit", inversedBy="activiteiten")
     * @ORM\JoinColumn(name="soort_id",referencedColumnName="id")
     * @Assert\NotBlank(message="Kies een soort activiteit uit")
     */

    private $soort;

    /**
     * Many Activiteiten have Many Users.
     * @ORM\ManyToMany(targetEntity="User", mappedBy="activiteiten")
     */

    private $users;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="vul een limiet in")
     */
    private $limiet;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getUsers()
    {
        return $this->users;
    }

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
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Activiteit
     */
    public function setDatum($datum)
    {

        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return string
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Get datum format dd-mm-yyyy
     *
     * @return string
     */
    public function getDatumFormatted()
    {
        return Carbon::parse($this->datum)->format('d-m-Y');
    }

    /**
     * Get datum format mm-dd-yyyy
     *
     * @return string
     */
    public function getDatumFormattedAmerican()
    {
        return Carbon::parse($this->datum)->format('m-d-Y');
    }

    /**
     * Set tijd
     *
     * @param \DateTime $tijd
     *
     * @return Activiteit
     */
    public function setTijd($tijd)
    {
        $this->tijd = $tijd;

        return $this;
    }

    /**
     * Get tijd
     *
     */
    public function getTijd()
    {
        return $this->tijd;
    }

    /**
     * Get tijd in string
     */
    public function getTijdFormatted()
    {
        return Carbon::parse($this->tijd)->format('H:i');
    }

    public function getSoort()
    {
        return $this->soort;
    }

    public function setSoort($soort)
    {
        $this->soort = $soort;
    }

    public function getLimiet(): ?int
    {
        return $this->limiet;
    }

    public function setLimiet(int $limiet): self
    {
        $this->limiet = $limiet;

        return $this;
    }

    public function getBeschikbarePlaatsen(): int
    {
        return $this->limiet - count($this->users);
    }

    public function isMogelijkOmInTeSchrijven(): bool
    {
        return $this->getBeschikbarePlaatsen() > 0;
    }
}

