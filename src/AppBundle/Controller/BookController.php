<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends Controller
{

	/**
	 * @Route("/library/book/search_cat/{cat}", name="book_search_cat")
	 */
	public function bookSearchCatAction($cat)
	{
		$bookRepository = $this->getDoctrine()
		                       ->getRepository(Book::class);

		$books = $bookRepository->searchByCategory($cat);

		dump($books); die;

	}

}