<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends Controller
{

	/**
	 * @Route("/library/author/search_resume/{word}", name="author_search_resume")
	 */
	public function bookSearchResumeAction($word)
	{

		$authorRepository = $this->getDoctrine()
		                         ->getRepository(Author::class);

		$authors = $authorRepository->searchByWordsInResume($word);

		dump($authors); die;
	}

}