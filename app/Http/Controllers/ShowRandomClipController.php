<?php

namespace App\Http\Controllers;

use App\Repositories\GetRandomClipRepository;
use Illuminate\Routing\Redirector;

class ShowRandomClipController extends Controller
{
    public function __construct(
        private GetRandomClipRepository $getRandomClipRepository,
        private Redirector $redirector,
    ) {}

    public function __invoke()
    {
        $clip = $this->getRandomClipRepository->handle();

        return $this->redirector->route('clips.show', $clip->uuid);
    }
}
