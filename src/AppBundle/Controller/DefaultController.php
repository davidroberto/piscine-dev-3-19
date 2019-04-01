<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

	/**
	 * action de controleur qui, pour l'url "/", exécute la méthode indexAction,
	 * qui retourne une vue twig, compilée en html grâce à la méthode render
	 *
	 * @Route("/", name="homepage")
	 */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/dump", name="dump")
     */
    public function dumpAction()
    {
    	var_dump("hello"); die;
    }

    /**
     * @Route("/response_symfony", name="response")
     */
    public function responseAction()
    {
    	$response = new Response("Réponse via le composant HttpFoundation");

    	return $response;
    }

    /**
     * @Route("/redirection", name="redirection")
     */
    public function redirectionAction()
    {
    	return $this->redirectToRoute("response");
	    //return $this->redirect("http://localhost:8888/piscine-exo-installer/web/app_dev.php/response");
    }

    /**
     * @Route("/request_query_parameter", name="request_query_parameter")
     */
    public function requestQueryParameterAction(Request $request)
    {
	    return new Response($request->query->get('age'));
    }

    /**
     * @Route("/blog/{page}", name="blog")
     */
    public function blogAction($page)
    {
    	var_dump($page); die;
    }

	/**
	 * @Route("/blog_data/{page}", name="blog_data")
	 */
	public function blogDataAction($page)
	{
		$titre1 = "Mon super article de blog";
		$titre2 = "Qu'est ce qu'un bottin";

		$contenu1 = "Voilà le contenu de mon article 1.";
		$contenu2 = "Et footix tu sais l'écrire ça ?";

		if (intval($page) === 1) {
			return new Response($titre1.' : '. $contenu1);
		} else if (intval($page) === 2) {
			return new Response($titre2.' : '. $contenu2);
		}
	}

	/**
	 * @Route("/dump", name="twig_beginner")
	 */
	public function twigBeginnerAction()
	{
		return $this->render('default/twig_beginner.html.twig');
	}

	/**
	 * @Route("/twig_variable/{age}", name="twig_variable")
	 */
	public function twigVariableAction($age)
	{

		$articles = ['article 1', 'article 2', 'article 3'];

		return $this->render(
			'twig_exo/variable.html.twig',
			[
				'age' => $age,
				'articles' => $articles
			]
		);
	}

	/**
	 * @Route("/articles", name="articles")
	 */
	public function articlesListAction()
	{
		$articles = [
			[
				'id' => 1,
				'title' => 'titre de mon article 1',
				'content' => 'contenu de mon article 1',
				'img' => 'https://camping-lesauberges.fr/wp-content/uploads/2018/10/3848765-wallpaper-images-download.jpg'
			],
			[
				'id' => 2,
				'title' => 'titre de mon article 2',
				'content' => 'contenu de mon article 2',
				'img' => 'https://camping-lesauberges.fr/wp-content/uploads/2018/10/3848765-wallpaper-images-download.jpg'
			],
			[
				'id' => 3,
				'title' => 'titre de mon article 3',
				'content' => 'contenu de mon article 3',
				'img' => 'https://camping-lesauberges.fr/wp-content/uploads/2018/10/3848765-wallpaper-images-download.jpg'
			],
			[
				'id' => 4,
				'title' => 'titre de mon article 4',
				'content' => 'contenu de mon article 4',
				'img' => 'https://camping-lesauberges.fr/wp-content/uploads/2018/10/3848765-wallpaper-images-download.jpg'
			]
		];

		return $this->render(
			'twig_exo/array_multi.html.twig',
			[
				'articles' => $articles
			]
		);
	}

	/**
	 * @Route("/articles/{id}", name="articles_single")
	 */
	public function articlesSingleAction($id)
	{
		$articles = [
			[
				'id' => 1,
				'title' => 'titre de mon article 1',
				'content' => 'contenu de mon article 1',
				'img' => 'https://camping-lesauberges.fr/wp-content/uploads/2018/10/3848765-wallpaper-images-download.jpg'
			],
			[
				'id' => 2,
				'title' => 'titre de mon article 2',
				'content' => 'contenu de mon article 2',
				'img' => 'https://camping-lesauberges.fr/wp-content/uploads/2018/10/3848765-wallpaper-images-download.jpg'
			],
			[
				'id' => 3,
				'title' => 'titre de mon article 3',
				'content' => 'contenu de mon article 3',
				'img' => 'https://camping-lesauberges.fr/wp-content/uploads/2018/10/3848765-wallpaper-images-download.jpg'
			],
			[
				'id' => 4,
				'title' => 'titre de mon article 4',
				'content' => 'contenu de mon article 4',
				'img' => 'https://camping-lesauberges.fr/wp-content/uploads/2018/10/3848765-wallpaper-images-download.jpg'
			]
		];


		$idCorrect = $id - 1;
		$article = $articles[$idCorrect];

		return $this->render(
			'twig_exo/article_single.html.twig',
			[
				'article' => $article,
				'articles' => $articles
			]
		);

	}

	/**
	 * @Route("/json", name="json")
	 */
	public function jsonAction()
	{
		// je vais récupérer un fichier json, sur les serveurs de github
		$json = file_get_contents('https://raw.githubusercontent.com/LearnWebCode/json-example/master/pets-data.json');

		// comme je ne peux pas exploiter directement le json en PHP,
		// j'utilise la fonction native de php json_decode,
		// pour convertir le json en objet / array php
		$jsonDecoded = json_decode($json);

		// j'appelle un fichier twig, et je lui passe un paramètre  "jsonDecoded"
		// qui contient notre json décodé en PHP
		return $this->render(
			'twig_exo/json.html.twig',
			[
				'jsonDecoded' => $jsonDecoded
			]
		);
	}

	/**
	 * @Route("/article_bdd", name="article_bdd")
	 */
	public function articleBddAction()
	{
		// je récupère une instance de Doctrine
		$articles = $this->getDoctrine()
			//je récupère le Repository de l'entité Article
			// (le repository me permet de faire des requêtes en bdd
            ->getRepository(Article::class)
			// j'utilise la méthode find du repository pour récupérer l'élément
			// dans la table article qui possède l'id 1.
            ->findAll();
		var_dump($articles); die;
	}

	/**
	 * @Route("/article_create", name="article_create")
	 */
	public function articleCreateAction()
	{
		// je viens créer une nouvelle instance de l'entité Article
		// cette entité article, représente un article à enregistrer
		// dans ma bdd
		$article = new Article();
		// j'utiliser le setter du titre, pour définir un titre sur
		// mon article
		$article->setTitle("titre depuis mon controleur");

		// je récupère l'entity manager qui me permet d'insérer des données
		// en bdd
		$entityManager = $this->getDoctrine()->getManager();

		// j'enregistre en base de données mon article
		$entityManager->persist($article);
		$entityManager->flush();


		return $this->render(
			'article/article_create.html.twig',
			[
				'article' => $article
			]
		);
	}

	/**
	 * @Route("/book_search_cat", name="book_search_cat")
	 */
	public function bookSearchCatAction()
	{
		$bookRepository = $this->getDoctrine()
		                       ->getRepository(Book::class);

		$books = $bookRepository->findByCategory();

	}
}
