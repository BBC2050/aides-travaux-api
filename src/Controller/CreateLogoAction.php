<?php

namespace App\Controller;

use App\Entity\Logo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateLogoAction
{
    public function __invoke(Request $request): Logo
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new Logo();
        $mediaObject->file = $uploadedFile;

        return $mediaObject;
    }
}
