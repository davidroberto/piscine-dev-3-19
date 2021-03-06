<?php

namespace AppBundle\Repository;

/**
 * BookRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookRepository extends \Doctrine\ORM\EntityRepository
{
	// création d'une nouvelle méthode du repository de Book
	// pour récupérer un ou plusieurs livres
	// en fonction de la category
	//
	// quand je créé une méthode dans cette classe,
	// je peux l'appeler depuis mon controleur, en
	// utilisant $this->getDoctrine()->getRepository(Book::Class)
	public function searchByCategory($cat)
	{

		// on utilise le query builder, qui nous permet
		// de créer des requêtes en base de données pour
		// la table Book (on est dans BookRepository)
		$qb = $this->createQueryBuilder('b');

		// je créé ma requête SQL en utilisant les
		// méthode de Doctrine, qui ressemblent à du SQL
		// et qui sont traduites par Doctrine en SQL
		// Cette requête vient récupérer dans la table Livres,
		// tous les livres dont la categorie est égale
		// à Science-fiction ($category contient "Science-fiction")
		$query = $qb->select('b')
					->where('b.category = :category')
					->setParameter('category', $cat)
					->getQuery();

		// Je récupère les résultats de ma requête
		$results = $query->getArrayResult();


		return $results;

	}


}
