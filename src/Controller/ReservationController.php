<?php
// src/Controller/ReservationController.php
namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Form\ReservationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class ReservationController extends AbstractFOSRestController
{
    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    /**
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param int $id
     * @return Response
     * @Route("/reservation/{id}", name="reservation", methods={"GET"})
     */
    public function getReservation(int $id)
    {
        $entityManager = $this->doctrine->getManager();
        $reservation = $entityManager->getRepository(Reservation::class)->find($id);

        if (!$reservation) {
            throw new ResourceNotFoundException( "Resource $id not found");
        }

        $view = $this->view($reservation, Response::HTTP_OK , []);

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @throws \Exception
     * @return Response
     * @Route("/reservation", name="createReservation", methods={"POST"})
     */
    public function postReservationAction(Request $request)
    {
        $reservation = new Reservation();
        $body = json_decode($request->getContent(), true);

        return $this->save($reservation, $this->formatData($body['data']));
    }

    /**
     * @param int $id
     * @param Request $request
     * @throws \Exception;
     * @return Response
     * @Route("/reservation/cancel/{id}", name="cancelReservation", methods={"PUT"})
     */
    public function cancelReservation(int $id, Request $request){
        $entityManager = $this->doctrine->getManager();

        /** @var Reservation $reservation */
        $reservation = $entityManager->getRepository(Reservation::class)->find($id);

        if (!$reservation) {
            throw new ResourceNotFoundException("Resource $id not found");
        }

        return $this->save($reservation, $this->formatData($reservation->toArray(), 0));
    }

    /**
     * @param int $id
     * @param Request $request
     * @throws \Exception;
     * @return Response
     * @Route("/reservation/changeseat/{id}", name="changeSeat", methods={"PUT"})
     */
    public function changeSeat(int $id,Request $request)
    {
        $entityManager = $this->doctrine->getManager();

        /** @var Reservation $reservation */
        $reservation = $entityManager->getRepository(Reservation::class)->find($id);

        if (!$reservation) {
            throw new ResourceNotFoundException("Resource $id not found");
        }

        $body = json_decode($request->getContent(), true);
        if (empty($body['data']['seat_number']) || $body['data']['seat_number'] < 1 || $body['data']['seat_number'] > 32) {
            throw new \Exception('Invalid seat number, seat number must be 1-32');
        }

        return $this->save($reservation, $this->formatData($reservation->toArray(), 1, $body['data']['seat_number']));
    }

    /**
     * @param array $data
     * @param $isActive
     * @return array
     */
    private function formatData(array $data, $isActive = 1, $seatNumber = false)
    {
        if (!($data['departure_time'] instanceof \DateTime)) {
            $data['departure_time'] = new \DateTime($data['departure_time']);
        }

        if ($seatNumber) {
            $data['seat_number'] = $seatNumber;
        } else {
            $data['seat_number'] = $isActive ? rand(1,32) : 0;
        }

        $data['is_active'] = $isActive;

        return $data;
    }

    /**
     * @param Reservation $reservation
     * @param array $data
     * @return Response
     */
    private function save(Reservation $reservation, array $data)
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();
            $view = $this->view($reservation, Response::HTTP_OK);

            return $this->handleView($view);
        } else {
            throw new \Exception('Data error');
        }
    }
}
?>