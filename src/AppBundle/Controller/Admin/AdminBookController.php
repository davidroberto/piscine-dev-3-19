<?php


namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Book;
use AppBundle\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookController extends Controller
{
	/**
	 * @Route("/library/book/list", name="book_list")
	 */
	public function bookListAction()
	{
		$bookRepository = $this->getDoctrine()
		                       ->getRepository(Book::class);

		$books = $bookRepository->findAll();

		dump($books); die;

	}

	/**
	 * @Route("/library/book/create", name="book_create")
	 */
	public function bookCreateAction(Request $request)
	{
		// Equivalent de passer la variable $request en parametre de
		// la méthode bookCreateAction.
		// la méthode createFromGlobals vient prendre les données
		// de $_POST, $_GET et les regroupe.
		//$request = Request::createFromGlobals();

		$book = new Book();

		// création du gabarit de formulaire en utilisant la classe BookType
		// générée par la ligne de commande generate:doctrine:form AppBundle:Book
		$bookForm = $this->createForm(BookType::class, $book);

		// utilisation du gabarit de formulaire pour créer une vue du formulaire
		// à envoyer dans le fichier twig
		$bookFormView = $bookForm->createView();

		// je récupère la variable $request, qui contient les données de la requête
		// et notamment les données de $_POST
		$bookForm->handleRequest($request);

		// je récupère ma variable $bookForm, qui contient désormais
		// mon formulaire avec les données de ma requête,
		// et je vérifie que des données ont bien été envoyées et
		// qu'elles sont valides par rapport à ce que demande
		// l'entité Book
		if  ($bookForm->isSubmitted() && $bookForm->isValid()) {

			// Je récupère l'image uploadée par l'utilisateur
			$image = $book->getImage();

			// Je génère un nom unique, suivi de l'extension de mon image
			$imageName = md5(uniqid()).'.'.$image->guessExtension();

			// Je déplace mon image dans un dossier en lui donnant
			// le nom unique que j'ai créé
			try {
				$image->move(
					$this->getParameter('upload_images_book'),
					$imageName
				);
			// si y'a une erreur dans l'upload, j'affiche l'erreur
			} catch (FileException $e) {
				throw new \Exception($e->getMessage());
			}

			// Je remets dans mon entité (qui sera sauvegardée en BDD)
			// le nom de l'image qu'on a créée.
			$book->setImage($imageName);

			// j'enregistre mon livre en base de données.
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($book);
			$entityManager->flush();

			var_dump('livre enregistré'); die;
		}

		return $this->render(
			'book/book_create_form.html.twig',
			[
				'bookFormView' => $bookFormView
			]
		);
	}

	/**
	 * @Route("/library/book/delete/{id}", name="book_delete")
	 */
	public function bookDeleteAction($id)
	{

		$bookRepository = $this->getDoctrine()->getRepository(Book::class);
		$book = $bookRepository->find($id);

		$entityManager = $this->getDoctrine()->getManager();

		$entityManager->remove($book);
		$entityManager->flush();

		var_dump('Livre supprimé'); die;
	}

	/**
	 * @Route("/library/book/update/{id}", name="book_update")
	 */
	public function bookUpdateAction($id)
	{
		$bookRepository = $this->getDoctrine()->getRepository(Book::class);

		$book = $bookRepository->find($id);

		$book->setTitle('titre modifié via le setter');
		$book->setNbPages(200);

		$entityManager = $this->getDoctrine()->getManager();

		// ligne pas nécessaire, le livre était déjà passé par l'unité de travail
		// via le find, donc pas besoin de le refaire passer par l'unité de travail
		$entityManager->persist($book);
		$entityManager->flush();

		var_dump('modification du titre via le setter'); die;
	}


	/**
	 * @Route("/library/book/details/{id}", name="book_details")
	 */
	public function bookDetailsAction($id)
	{
		$bookRepository = $this->getDoctrine()
		                       ->getRepository(Book::class);

		$book = $bookRepository->find($id);

		return $this->render(
			'book/book_details.html.twig',
			[
				'book' => $book
			]
		);

	}
}