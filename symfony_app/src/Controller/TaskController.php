<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/api/task", name="api_task_")
 */
class TaskController extends AbstractController
{
    private $categoryRepository;
    private $serializer;
    private $taskRepository;

    public function __construct(CategoryRepository $categoryRepository, TaskRepository $taskRepository, SerializerInterface $serializer)
    {
        $this->categoryRepository = $categoryRepository;
        $this->taskRepository = $taskRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/", name="browse")
     */
    public function browse(): Response
    {
        return $this->json($this->serializer->normalize($this->taskRepository->findTasks(), null, ['groups' => ['task', 'task_category', 'category']]));
    }

    /**
     * @Route("/{id}", name="read", requirements={"id"="\d+"})
     */
    public function read($id): Response
    {
        return $this->json($this->serializer->normalize($this->taskRepository->findTask($id), null, ['groups' => ['task', 'task_category', 'category']]));
    }

    /**
     * @Route("/status/{status}", name="browse_status", requirements={"status"="\d+"})
     */
    public function browseStatus($status): Response
    {
        return $this->json($this->serializer->normalize($this->taskRepository->findTasksStatus($status), null, ['groups' => ['task', 'task_category', 'category']]));
    }

    /**
     * @Route("/category/{category}", name="browse_category", requirements={"category"="\d+"})
     */
    public function browseCategory($category): Response
    {
        try {
            if($this->categoryRepository->findCategory($category)) {
                return $this->json($this->serializer->normalize($this->taskRepository->findTasksCategory($category), null, ['groups' => ['task', 'task_category', 'category']]));
            }
            throw $this->createNotFoundException('The category does not exist');
        } catch (\Error $e) {
               error_log("Error caught: " . $e->getMessage());
        }
    }

    /**
     * @Route("/status/{status}/category/{category}", name="browse_status_category", requirements={"status"="\d+", "category"="\d+"})
     */
    public function browseStatusCategory($status, $category): Response
    {
        try {
            if($this->categoryRepository->findCategory($category)) {
                return $this->json($this->serializer->normalize($this->taskRepository->findTasksStatusCategory($status, $category), null, ['groups' => ['task', 'task_category', 'category']]));
            }
            throw $this->createNotFoundException('The category does not exist');
        } catch (\Error $e) {
               error_log("Error caught: " . $e->getMessage());
        }
    }
}
