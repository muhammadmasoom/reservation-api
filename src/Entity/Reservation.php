<?php
// src/Entity/Reservation.php
namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * App\Entity\Reservation
 *
 * @ORM\Entity
 * @ORM\Table(name="FlightReservation")
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departureTime;

    /**
     * @ORM\Column[length: 255]
     */
    private $departureAirport;

    /**
     * @ORM\Column[length: 255]
     */
    private $destinationAirport;

    /**
     * @ORM\Column(type="integer")
     */
    private $seatNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column[length: 255]
     */
    private $passport;




    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPassport()
    {
        return $this->passport;
    }

    /**
     * @param mixed $passport
     */
    public function setPassport($passport): void
    {
        $this->passport = $passport;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * @param \DateTimeInterface $departureTime
     */
    public function setDepartureTime($departureTime): void
    {
        $this->departureTime = $departureTime;
    }

    /**
     * @return int
     */
    public function getSeatNumber(): int
    {
        return $this->seatNumber;
    }

    /**
     * @param int $seatNumber
     */
    public function setSeatNumber($seatNumber): void
    {
        $this->seatNumber = $seatNumber;
    }

    /**
     * @return string
     */
    public function getDepartureAirport(): string
    {
        return $this->departureAirport;
    }

    /**
     * @param string $departureAirport
     */
    public function setDepartureAirport($departureAirport): void
    {
        $this->departureAirport = $departureAirport;
    }

    /**
     * @return string
     */
    public function getDestinationAirport(): string
    {
        return $this->destinationAirport;
    }

    /**
     * @param string $destinationAirport
     */
    public function setDestinationAirport($destinationAirport): void
    {
        $this->destinationAirport = $destinationAirport;
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'departure_time' => $this->getDepartureTime(),
            'departure_airport' => $this->getDepartureAirport(),
            'destination_airport' => $this->getDestinationAirport(),
            'passport' => $this->getPassport(),
            'is_active' => $this->getIsActive(),
            'seat_number' => $this->getSeatNumber()
        ];
    }
}

?>