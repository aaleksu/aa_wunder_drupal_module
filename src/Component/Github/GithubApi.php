<?php

namespace Drupal\aa\Component\Github;

use Drupal\aa\Component\CurlClient\CurlClient;

class GithubApi
{
    public function getRepos()
    {
        $cachedRepos = GithubApiCache::get('https://api.github.com/users/aaleksu/repos');
        if($cachedRepos == null) {
            $repos = (new CurlClient)
                ->setUserAgent('AA github api client')
                ->setUrl('https://api.github.com/users/aaleksu/repos')
                ->execute()
            ;

            GithubApiCache::set('https://api.github.com/users/aaleksu/repos', json_decode($repos, true));
        }
        else {
            $repos = $cachedRepos;
        }

        return $repos;
    }
}
