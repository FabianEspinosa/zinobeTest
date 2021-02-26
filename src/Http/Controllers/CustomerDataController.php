<?php
declare (strict_types = 1);
namespace App\Http\Controllers;

require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../bootstrap.php';

use App\Entity\Users;
use App\Http\Traits\Services;
use App\Kernel\Request;
use App\Kernel\Response;
use Rakit\Validation\Validator;

class CustomerDataController
{
    use Services;

    public function index(Request $request)
    {
        Response::view('register', $request->getParameters());
    }
    
    public function search(Request $request)
    {
        Response::view('search', $request->getParameters());
    }
    

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
            Response::view('register', ['msg' => 'Rectifique los datos']);
        } else {
            $entityManager = getEntityManager();
            $usersEmail    = $entityManager->getRepository(Users::class)->findOneBy(array('email' => $data['email']));
            $usersDocument = $entityManager->getRepository(Users::class)->findOneBy(array('document' => $data['document']));

            if (isset($usersEmail) || isset($usersDocument)) {
                Response::view('register', ['userAlreadyExist' => 1]);
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
                    Response::view('register', ['msg' => 'No se pudo crear el usuario']);
                }
                Response::view('register', ['userCreated' => 1]);
            }
        }
    }

    public static function countriesList()
    {
        $countries = Services::consumeCountryApi();
        if ($countries != 404) {
            $countrySelect = '<select name ="country">';
            foreach ($countries as $country) {
                $countrySelect .= '<option value=' . $country['alpha2Code'] . '>' . $country['name'] . '</option>';
            }
            $countrySelect .= '</select>';
            return $countrySelect;
        } else {
            return '<div>No se pudo cargar la lista de paises</div>';
        }

    }

}
