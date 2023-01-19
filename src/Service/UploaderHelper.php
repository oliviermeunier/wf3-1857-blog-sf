<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    public function __construct(
        private SluggerInterface $slugger,
        private string $postImageDirectory
    ) {
    }


    public function uploadPostImage($post, ?UploadedFile $uploadedFile)
    {
        if ($uploadedFile) {

            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $this->slugger->slug($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

            $post->setImage($newFilename);

            $uploadedFile->move($this->postImageDirectory, $newFilename);
        }
    }
}
