<?php

namespace App\Controller;


use App\Entity\Episode;
use App\Entity\Season;
use App\Entity\Program;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/program", name="program_")
 */

class ProgramController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */

    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render('program/index.html.twig', [

            'programs' => $programs]);
    }

    /**
     * @Route("/show/{id<^[0-9]+$>}", name="show")
     */

    public function show(Program $program): Response
    {
        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findBy(['program' => $program]);


        return $this->render('program/show.html.twig', ['program' => $program, 'seasons'=>$seasons]);
    }

    /**
     * @Route("/{program}/season/{season}" , name ="season_show")
     */

    public function showSeason(Program $program, Season $season)
    {
        $episodes = $this->getDoctrine()
            ->getRepository(Episode::class)
            ->findBy(['season'=> $season]);

        return $this->render('/program/season_show.html.twig', [
            'program' => $program,
            'season'  => $season,
            'episodes' => $episodes
        ]);
    }

    /**
     * @Route("{program}/season/{season}/episode/{episode}", name="episode_show")
     *
     */
    public function showEpisode(Program $program,Season $season,Episode $episode)
    {
        return $this->render('/program/episode_show.html.twig', [
            'program'=>$program,
            'season'=>$season,
            'episode'=>$episode,
        ]);
    }

}


