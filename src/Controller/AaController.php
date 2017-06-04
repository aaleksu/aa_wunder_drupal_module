<?php

namespace Drupal\aa\Controller;

use Drupal\Core\Controller\ControllerBase;

class AaController extends ControllerBase
{
    public function content()
    {
        return [
            '#theme' => 'index',
        ];
    }

    public function github()
    {
        try {
            $repos = (new \Drupal\aa\Component\Github\GithubApi)->getRepos();

            return [
                '#theme' => 'github',
                '#repositories' => $repos,
            ];
        }
        catch(\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function projects()
    {
        return [
            '#theme' => 'projects',
        ];
    }

    private function errorResponse($error)
    {
        return [
            '#theme' => 'error',
            '#message' => $error,
        ];
    }
}
