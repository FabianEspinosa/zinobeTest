<?php
declare (strict_types = 1);
namespace App\Http\Controllers;

require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../bootstrap.php';

use App\Entity\Users;
use App\Kernel\Request;
use App\Kernel\Response;
use Rakit\Validation\Validator;

class AuthController
{
    public function login(Request $request)
    {

        $validator  = new Validator;
        $data       = $request->getParameters();
        $validation = $validator->validate($data, [
            'document' => 'required|numeric',
            'password' => 'required|min:6',
        ]);
        if ($validation->fails()) {
            Response::view('login', ['msg' => 'Rectifique los datos']);
        } else {
            $entityManager = getEntityManager();
            $user          = $entityManager->getRepository(Users::class)->findOneBy(array('document' => $data['document']));
            if (!empty($user)) {
                if (sha1($data['password']) == $user->getPassword()) {
                    AuthController::createSession($user->getId(), $user->getUsername(), $user->getEmail());
                } else {
                    Response::view('login', ['msg' => 'Contraseña incorrecta']);
                }
            } else {
                Response::view('login', ['msg' => 'Usuario no encontrado']);
            }

        }
    }

    public function createSession(int $id, string $username, string $email)
    {
        session_start();
        $_SESSION['userId']  = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email']    = $email;       
        Response::redirect('search');
    }
}
