<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        $kong = new \TheRealGambo\Kong\Kong('http://localhost');
        $node = $kong->getNodeObject();

        print_r($node->getInformation());
        
        // print_r($kong->getServiceObject()->list());
        // print_r($kong->getServiceObject()->add(['name'=>'test', 'host' => 'terst']));
        // print_r($kong->getUpstreamObject()->add(['name'=>'upstream', 'slots' => 2000]));
        // print_r($kong->getUpstreamObject()->get('dd4fea53-eb33-4373-b368-0f3ab8c75be4', ['name'=>'upstream']));
        print_r($kong->getUpstreamObject()->addTarget('dd4fea53-eb33-4373-b368-0f3ab8c75be4', ['weight'=>40, 'target' => 'localhost:11']));

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }
}
