<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostType;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPostController extends AbstractController
{
    #[Route('/admin/post/new', name: 'admin.post.new')]
    public function new(
        Request $request,
        SluggerInterface $slugger,
        EntityManagerInterface $manager,
        UploaderHelper $uploaderHelper
    ): Response {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->getUser());
            $post->setSlug($slugger->slug($post->getTitle()));

            $uploaderHelper->uploadPostImage($post, $form->get('imageFile')->getData());

            $manager->persist($post);
            $manager->flush();

            $this->addFlash('success', 'Article ajouté avec succès.');
            return $this->redirectToRoute('admin.index');
        }


        return $this->render('admin/post/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
