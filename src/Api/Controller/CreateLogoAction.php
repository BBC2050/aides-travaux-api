<?php

namespace App\Api\Controller;

use App\Entity\Dispositif;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateLogoAction
{
    public function __invoke(Request $request): Dispositif
    {
        $dispositif = $request->attributes->get('data');
        $file = $request->files->get('file');

        if (!$dispositif instanceof Dispositif) {
            throw new \RuntimeException('Dispositif introuvable');
        }
        if (!$file) {
            throw new BadRequestHttpException('"file" is required');
        }

        $dispositif->setFile($file);
        $dispositif->setDateUpload(new \DateTime());

        return $dispositif;
    }
}
