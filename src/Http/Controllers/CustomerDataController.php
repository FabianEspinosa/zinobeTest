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
    
    public function welcome(Request $request)
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
            $usersEmail    = $entityManager->getRepository(Users::class)->findOneBy(array('email' => trim($data['email'])));
            $usersDocument = $entityManager->getRepository(Users::class)->findOneBy(array('document' => trim($data['document'])));

            if (isset($usersEmail) || isset($usersDocument)) {
                Response::view('register', ['userAlreadyExist' => 1]);
            } else {
                $entityManager = getEntityManager();
                $user          = new Users();
                $user->setUsername(trim($data['username']));
                $user->setDocument(trim($data['document']));
                $user->setEmail(trim($data['email']));
                $user->setCountry(trim($data['country']));
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

    public function searchUser(Request $request)
    {
        $validator  = new Validator;
        $data       = $request->getParameters();
        $validation = $validator->validate($data, [
            'dataField' => 'required|min:3'            
        ]);
        if ($validation->fails()) {
            Response::view('search', ['msg' => 'Rectifique los datos']);
        } else {
            $entityManager = getEntityManager();
            if (is_numeric($data['dataField'])) {
                $userFind = $entityManager->getRepository(Users::class)->findOneBy(array('document' => trim($data['dataField'])));
            } else {
                $userFind = $entityManager->getRepository(Users::class)->findOneBy(array('email' => trim($data['dataField'])));
            }          
            if (isset($userFind)) {
                $data["userCard"]["name"] = $userFind->getUsername();
                $data["userCard"]["document"] = $userFind->getdocument();
                $data["userCard"]["email"]   = $userFind->getEmail();
                $countryCode = $userFind->getCountry();
                $countryData = Services::consumeCountryApiByCode($countryCode);
                $data["userCard"]["country"] = $countryData["name"]."($countryCode)";                
                Response::view('search', $data);
            } else {
                Response::view('search', ['msg' => 'Usuario no encontrado']);
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
