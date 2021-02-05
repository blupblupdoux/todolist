<?php

namespace App\Controller;

use App\Entity\Task;
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
        $tasks = $this->taskRepository->findTasks();

        // dd($tasks);

        $bla = $this->serializer->normalize($tasks, null, ['groups' => ['task']]);

        return $this->json($bla);
    }

    /**
     * @Route("/{id}", name="read", requirements={"id"="\d+"})
     */
    public function read($id): Response
    {
        dd($this->task->findTask($id));

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TaskController.php',
        ]);
    }
}
