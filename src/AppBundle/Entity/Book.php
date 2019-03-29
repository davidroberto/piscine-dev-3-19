<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookRepository")
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPages", type="integer", nullable=true)
     */
    private $nbPages;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    private $resume;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId( int $id ) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle( string $title ) {
		$this->title = $title;
	}

	/**
	 * @return int
	 */
	public function getNbPages(): int {
		return $this->nbPages;
	}

	/**
	 * @param int $nbPages
	 */
	public function setNbPages( int $nbPages ) {
		$this->nbPages = $nbPages;
	}

	/**
	 * @return string
	 */
	public function getResume(): string {
		return $this->resume;
	}

	/**
	 * @param string $resume
	 */
	public function setResume( string $resume ) {
		$this->resume = $resume;
	}

	/**
	 * @return string
	 */
	public function getCategory(): string {
		return $this->category;
	}

	/**
	 * @param string $category
	 */
	public function setCategory( string $category ) {
		$this->category = $category;
	}


}

