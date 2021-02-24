<?php
declare (strict_types = 1);
namespace App\Http\Controllers;

require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../bootstrap.php';

use App\Entity\Users;
use App\Kernel\Request;
use App\Kernel\Response;

class AuthController
{
    public function login(Request $request)
    {
        $data = $request->getParameters();

        if (isset($data['user']) && isset($data['password'])) {
            $entityManager = getEntityManager();
            $users         = $entityManager->getRepository(Users::class)->findOneBy(array('username' => $data['user']));
        } else {
            Response::json(['msg'=>'Unauthorized','code'=>'400']);
        }        
    }    
}
