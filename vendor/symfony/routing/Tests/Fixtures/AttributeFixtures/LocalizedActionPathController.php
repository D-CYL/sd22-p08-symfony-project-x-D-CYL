<?php

namespace Symfony\Component\Routing\Tests\Fixtures\AttributeFixtures;

use Symfony\Component\Routing\Attribute\Route;

class LocalizedActionPathController
{
    #[Route(path: ['en' => '/path', 'nl' => '/pad'], name: 'action')]
    public function action()
    {
    }
}
