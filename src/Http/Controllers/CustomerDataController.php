<?php
declare (strict_types = 1);
namespace App\Http\Controllers;

require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../bootstrap.php';

use App\Entity\Users;
use App\Kernel\Request;
use App\Kernel\Response;
use Rakit\Validation\Validator;

class CustomerDataController
{
    public function createUser(Request $request)
    {
        $validator  = new Validator;
        $data       = $request->getParameters();
        $validation = $validator->validate($data, [
            'username'  => 'required|min:3',
            'document'  => 'required|numeric',
            'email'     => 'required|email',
            'password'  => 'required|min:6',
            'password2' => 'required|same:password',
            'country'   => 'required',
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors();            
            Response::view('login',$errors->firstOfAll());
            exit;
        } else {
            $entityManager = getEntityManager();
            $usersEmail    = $entityManager->getRepository(Users::class)->findOneBy(array('email' => $data['email']));
            $usersDocument = $entityManager->getRepository(Users::class)->findOneBy(array('document' => $data['document']));

            if (isset($usersEmail) || isset($usersDocument)) {               
                Response::view('login',['userAlreadyExist'=>1]);
                exit;
            } else {
                $entityManager = getEntityManager();
                $user          = new Users();
                $user->setUsername($data['username']);
                $user->setDocument($data['document']);
                $user->setEmail($data['email']);
                $user->setCountry($data['country']);
                $user->setPassword(sha1($data['password']));
                try {
                    $entityManager->persist($user);
                    $entityManager->flush($user);
                } catch (Exception $e) {
                    Response::json(["msg" => $e->getMessage, "code" => 400]);
                    Response::redirect('/');
                }
                Response::view('login',['userCreated'=>1]);
            }
        }
    }

}
