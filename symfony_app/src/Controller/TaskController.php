<?php

namespace App\Controller;

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
    private $taskRepository;
    private $serializer;

    public function __construct(TaskRepository $taskRepository, SerializerInterface $serializer)
    {
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
     * @Route("/complete", name="browse_complete")
     */
    public function browseComplete(): Response
    {
        return $this->json($this->serializer->normalize($this->taskRepository->findTasksStatus(1), null, ['groups' => ['task', 'task_category', 'category']]));
    }

    /**
     * @Route("/incomplete", name="browse_incomplete")
     */
    public function browseIncomplete(): Response
    {
        return $this->json($this->serializer->normalize($this->taskRepository->findTasksStatus(0), null, ['groups' => ['task', 'task_category', 'category']]));
    }

    /**
     * @Route("/archived", name="browse_archived")
     */
    public function browseArchived(): Response
    {
        return $this->json($this->serializer->normalize($this->taskRepository->findTasksStatus(2), null, ['groups' => ['task', 'task_category', 'category']]));
    }
}
