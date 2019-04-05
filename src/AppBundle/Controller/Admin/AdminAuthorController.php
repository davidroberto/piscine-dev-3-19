<?php


namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


class AdminAuthorController extends Controller
{
	/**
	 * @Route("admin/library/author/list", name="author_list")
	 */
	public function authorListAction()
	{
		$authorRepository = $this->getDoctrine()
		                         ->getRepository(Author::class);

		$authors = $authorRepository->findAll();

		dump($authors); die;

	}


	/**
	 * @Route("/library/author/create", name="author_create")
	 */
	public function authorCreateAction()
	{
		$entityManager = $this->getDoctrine()->getManager();

		$author = new Author();

		$author->setName('Robert');
		$author->getBio('blabla');
		$author->setBirthDate(new \DateTime('1990-01-22'));

		dump('auteur enregistré'); die;

	}




	/**
	 * @Route("/library/author/details/{id}", name="author_details")
	 */
	public function authorDetailsAction($id)
	{
		$authorRepository = $this->getDoctrine()
		                         ->getRepository(Author::class);

		$author = $authorRepository->find($id);

		return $this->render(
			'author/author_details.html.twig',
			[
				'author' => $author
			]
		);

	}

}