<?php 

    namespace App\Repositories;

    use App\Models\UserModel;
    use Illuminate\Support\Facades\Validator;

    class UserRepository {

        /**
         * Pega/pesquisa o usuario pelo id no banco de dados
         * @author douglas
        */
        public static function getMemberById( $id ) {
            $userModel = new UserModel;
            return $userModel->getUserById($id);
        }


        /**
         * Faz a validação dos dados recebidos do service e chama a função da model onde será 
         * feito o criação do usuario no banco
         * @author douglas
        */
        public static function createMember( $fields ) {
            // Instancia e executa a função responsavel por criar o usuário
            $userModel = new UserModel;
            $new_member = $userModel->createUser($fields);

            
            // Caso der tudo certo na execução da função, retorna com o boolean true 
            if($new_member === true) {
                return response()->json(['success' => true, 'error' => null], 200);
            } 

            return response()->json(['success' => false, 'error' => $new_member], 500);
        }


        /**
         * Faz a validação dos dados recebidos do service e chama a função da model onde será 
         * feito a atualização dos dados do usuario no banco
         * @author douglas
        */
        public static function updateMember( $id, $fields ) {
            // Instancia e executa a função responsavel por atualizar o usuário
            $userModel = new UserModel;
            $update_member = $userModel->updateUser($id, $fields);

            // Caso der tudo certo na execução da função, retorna com o boolean true 
            if($update_member === true) {
                return response()->json(['success' => true, 'error' => null], 200);
            }

            return response()->json(['success' => false, 'error' => $update_member], 400);
        }

        /**
         * Deleta o usuário do banco de dados
         * @author douglas
        */
        public static function deleteMember( $id ) {
            // Instancia e executa a função responsavel por excluir o usuário
            $userModel = new UserModel;
            $update_member = $userModel->deleteUser($id);

            // Caso der tudo certo na execução da função, retorna com o boolean true 
            if($update_member === true) {
                return response()->json(['success' => true, 'error' => null], 200);
            }

            return response()->json(['success' => false, 'error' => $update_member], 500);
        }


        /**
         * Responsável por trazer a lista de todos os usuário do banco de dados
         * @author douglas
        */
        public static function listMembers() {
            // Instancia, executa e retorna a listagem dos usuários
            $userModel = new UserModel;
            return $userModel->listMembers();
        }

    }