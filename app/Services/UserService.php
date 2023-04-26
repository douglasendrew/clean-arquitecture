<?php 

    namespace App\Services;

    use App\Repositories\UserRepository;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class UserService {

        /**
         * Service responsável por administrar a consulta de um usuário especifico
         * @author douglas
        */
        public static function getUserById($id_user) {
            // Verifica se o usuário existe
            if(empty(UserRepository::getMemberById($id_user))) {
                return response()->json(['success' => false, 'error' => 'User not found'], 404);
            }

            return UserRepository::getMemberById($id_user);
        }


        /**
         * Service responsável por administrar a criação de um usuário
         * @author douglas
        */
        public static function createUser($request) {
            // Faz a validação dos campos recebidos
            $validator = Validator::make($request, [
                'username' => 'required|string',
                'complete_name' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|string|max:32',
            ],
            [
                'required' => 'O :attribute é obrigatório.',
            ]);


            // Se alguma validação der errado, retorna com os erros
            if ($validator->fails()) {
                return response()->json($validator->getMessageBag(), 400);
            }

            return UserRepository::createMember($request);
        }


        /**
         * Service responsável por administrar a atualização de um usuário
         * @author douglas  
        */
        public static function updateUser( $id, $request ) {
            // Faz a validação dos campos recebidos
            $validator = Validator::make($request, [
                'username' => 'required|string',
                'complete_name' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|string|max:32',
            ],
            [
                'required' => 'O :attribute é obrigatório.',
            ]);


            // Se alguma validação der errado, retorna com os erros
            if ($validator->fails()) {
                return response()->json($validator->getMessageBag(), 400);
            }


            // Verifica se o email que veio pelo post é o mesmo que está no banco
            if($request['email'] == UserRepository::getMemberById($id)[0]->email) {
                unset($request['email']);
            }

            return UserRepository::updateMember($id, $request);
        }


        /**
         * Service responsável por administrar a exclusão de um usuário
         * @author douglas
        */
        public static function deleteUser( $id ) {
            // Verifica se o usuário existe
            if(empty(UserRepository::getMemberById($id))) {
                return response()->json(['success' => false, 'error' => 'User not found'], 404);
            }

            return UserRepository::deleteMember($id);
        }


        /**
         * Service responsável por administrar a listagem de usuários
         * @author douglas
        */
        public static function listUsers() {
            return UserRepository::listMembers();
        }

    }