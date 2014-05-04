<?php

namespace App\CategoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="App\CategoryBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @var File $image
     *
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     */
    protected $image;

    /**
     * @var string $imageName
     *
     * @ORM\Column(name="image_name", type="string", length=255, nullable=true)
     */
    protected $imageName;

    /**
     * @var int
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=true)
     */
    protected $timestamp;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     * @return Category
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string 
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set timestamp
     *
     * @param integer $timestamp
     * @return Category
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return integer 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\File $image
     * @return Category
     */
    public function setImage($image)
    {
        $this->image = $image;
        $this->setTimestamp(time());
        return $this;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\File\File
     */
    public function getImage()
    {
        return $this->image;
    }
}
