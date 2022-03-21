<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\CalendarAccount;
use App\Form\CalendarAccountType;
use App\Repository\CalendarAccountRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarsController extends AbstractController
{
    private ObjectManager $entityManager;
    private CalendarAccountRepository $repository;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->entityManager = $doctrine->getManager();
        $this->repository = $doctrine->getRepository(CalendarAccount::class);
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    #[Route('/calendars', name: 'app_calendars')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $accounts = $this->repository->findByUser($user);

        $account = new CalendarAccount();
        $form = $this->createForm(CalendarAccountType::class, $account);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CalendarAccount $account */
            $account = $form->getData();

            $account->setCalendarUser($user);
            $this->entityManager->persist($account);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_calendars');
        }

        return $this->renderForm('calendars/index.html.twig', [
            'accounts' => $accounts,
            'form' => $form,
        ]);
    }
}
