<?php


namespace App\Service;


use App\Entity\Authority;
use App\Entity\Image;
use App\Entity\Kontakt;
use App\Entity\Message;
use App\Entity\NavBarHref;
use App\Entity\OpenHours;
use App\Entity\Problem;
use App\Entity\Proza;
use App\Entity\Sender;
use App\Entity\Slideshow;
use App\Entity\User;
use App\Entity\Usluga;
use App\Entity\Zabieg;
use App\Repository\AuthorityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class RepoService
{

    private $em;

    /**
     * RepoService constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAuthorityRepo(){
        return $this->em->getRepository(Authority::class);
    }
    public function getImageRepo(){
        return $this->em->getRepository(Image::class);
    }
    public function getKontaktRepo(){
        return $this->em->getRepository(Kontakt::class);
    }
    public function getMessageRepo(){
        return $this->em->getRepository(Message::class);
    }
    public function getNavBarHrefRepo(){
        return $this->em->getRepository(NavBarHref::class);
    }
    public function getOpenHoursRepo(){
        return $this->em->getRepository(OpenHours::class);
    }
    public function getProblemRepo(){
        return $this->em->getRepository(Problem::class);
    }
    public function getProzaRepo(){
        return $this->em->getRepository(Proza::class);
    }
    public function getSenderRepo(){
        return $this->em->getRepository(Sender::class);
    }
    public function getSlideshowRepo(){
        return $this->em->getRepository(Slideshow::class);
    }
    public function getUserRepo(){
        return $this->em->getRepository(User::class);
    }
    public function getUslugaRepo(){
        return $this->em->getRepository(Usluga::class);
    }
    public function getZabiegRepo(){
        return $this->em->getRepository(Zabieg::class);
    }
    public function getEntityManager(){
        return $this->em;
    }
}