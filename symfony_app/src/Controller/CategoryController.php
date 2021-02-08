<?php

namespace App\Controller;

use App\Repository\CategoryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/api/category", name="api_category_")
 */
class CategoryController extends AbstractController
{
    private $categoryRepository;
    private $serializer;

    public function __construct(CategoryRepository $categoryRepository, SerializerInterface $serializer)
    {
        $this->categoryRepository = $categoryRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/", name="browse")
     */
    public function browse(): Response
    {
        return $this->json($this->serializer->normalize($this->categoryRepository->findCategories(), null, ['groups' => ['category', 'category_tasks', 'task']]));
    }

    /**
     * @Route("/{id}", name="read", requirements={"id"="\d+"})
     */
    public function read($id): Response
    {
        return $this->json($this->serializer->normalize($this->categoryRepository->findCategory($id), null, ['groups' => ['category', 'category_tasks', 'task']]));
    }
}
