<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/api/task", name="api_task_")
 */
class TaskController extends AbstractController
{
    private $categoryRepository; 
    private $em;
    private $serializer;
    private $taskRepository;

    public function __construct(CategoryRepository $categoryRepository, EntityManagerInterface $em, TaskRepository $taskRepository, SerializerInterface $serializer)
    {
        $this->categoryRepository = $categoryRepository;
        $this->em = $em;
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
        try 
        {
            if($this->categoryRepository->findCategory($category)) {
                return $this->json($this->serializer->normalize($this->taskRepository->findTasksStatusCategory($status, $category), null, ['groups' => ['task', 'task_category', 'category']]));
            }
            throw $this->createNotFoundException('The category does not exist');
        } catch (\Error $e) 
        {
            error_log("Error caught: " . $e->getMessage());
        }
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request) : Response
    {
        try 
        {
            $data = json_decode($request->getContent(), true);

            if($data)
            {
                $task = new Task();
            
                $form = $this->createForm(TaskType::class, $task);
                $form->submit($data);

                if($form->isSubmitted())
                {
                    $this->em->persist($form->getData());
                    $this->em->flush();
                    return new Response(null, Response::HTTP_CREATED);
                }
            }
            return new Response('Request can not be empty', Response::HTTP_BAD_REQUEST);

        } catch (\Error $e) 
        {
               error_log("Error caught: " . $e->getMessage());
        }
    }

    /**
     * @Route("/edit", name="edit")
     */
    public function edit(Request $request) : Response
    {
        try 
        {
            $data = json_decode($request->getContent(), true);

            if($data)
            { 
                if(array_key_exists('id', $data))
                {
                    $task = $this->taskRepository->find($data['id']);

                    if($task) {

                        $form = $this->createForm(TaskType::class, $task);
                        $form->submit($data);

                        if($form->isSubmitted())
                        {
                            $form->getData()->setUpdatedAt(new \DateTime());
                            $this->em->flush();
                            return new Response('Task n°' . $form->getData()->getId() . ' edited', Response::HTTP_OK);
                        }
                    }
                    return new Response('Task not found', Response::HTTP_NOT_FOUND);
                }
                return new Response('Invalid request content', Response::HTTP_BAD_REQUEST);
            }
            return new Response('Request can not be empty', Response::HTTP_BAD_REQUEST);

        } catch (\Error $e) 
        {
               error_log("Error caught: " . $e->getMessage());
        }
    }

    /**
     * @Route("/edit/status/{status}", name="edit_status", requirements={"status"="\d+"})
     */
    public function editStatus($status, Request $request) : Response
    {
        try 
        {
            $data = json_decode($request->getContent(), true);

            if($data)
            { 
                if(array_key_exists('id', $data))
                {
                    $task = $this->taskRepository->find($data['id']);

                    if($task) 
                    {
                        $task->setUpdatedAt(new \DateTime());
                        $task->setStatus($status);
                        $this->em->flush();
                        return new Response('Status of task n°' . $task->getId() . ' edited', Response::HTTP_OK);
                    }
                    return new Response('Task not found', Response::HTTP_NOT_FOUND);
                }
                return new Response('Invalid request content', Response::HTTP_BAD_REQUEST);
            }
            return new Response('Request can not be empty', Response::HTTP_BAD_REQUEST);

        } catch (\Error $e) 
        {
               error_log("Error caught: " . $e->getMessage());
        }
    }
}