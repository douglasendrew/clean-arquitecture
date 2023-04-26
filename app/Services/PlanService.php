<?php 

namespace App\Services;

use App\Models\PlanModel;
use App\Repositories\PlanRepository;
use Illuminate\Support\Facades\Validator;

class PlanService 
{
    /**
     * Service responsavel por administrar toda consulta de um plano especifico
     * @author douglas 
     */
    public static function getPlanById( $id ) {
        return PlanRepository::getPlanById($id);
    }


    /**
     * Service responsavel por administrar toda criação de um plano
     * @author douglas 
    */
    public static function createPlan($request) {
        // Verifica se todos parametros obrigatorios foram preenchidos
        $validator = Validator::make($request, [
            'nome_plano' => 'string|required|max:64',
            'periodo_plano' => 'int|required'
        ],
        [
            'required' => 'O :attribute é obrigatório.',
        ]);


        // Retorna os parametros que deram erro caso algum nao seja preenchido ou nao esteja dentro dos requisitos
        if($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }

        return PlanRepository::createPlan($request);

    }



    /**
     * Service responsavel por administrar toda atuzalização de um plano
     * @author douglas 
    */
    public static function updtPlan($id, $request) {
        // Verifica se todos parametros obrigatorios foram preenchidos
        $validator = Validator::make($request, [
            'nome_plano' => 'string|required|max:64',
            'periodo_plano' => 'int|required'
        ],
        [
            'required' => 'O :attribute é obrigatório.',
        ]);


        // Retorna os parametros que deram erro caso algum nao seja preenchido ou nao esteja dentro dos requisitos
        if($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }

        return PlanRepository::updatePlan($id, $request);

    }


    /**
     * Service responsavel por deletar um plano
     * @author douglas 
    */
    public static function delPlan($id) {
        return PlanRepository::deletePlan($id);
    }


    /**
     * Service responsavel por atribuir um plano a um usuario
     * @author douglas 
    */
    public static function attrPlan($request) {
        // Verifica se todos parametros obrigatorios foram preenchidos
        $validator = Validator::make($request, [
            'id_plano' => 'int|required',
            'id_usuario' => 'int|required'
        ],
        [
            'required' => 'O :attribute é obrigatório.',
        ]);

        // Verifica se o plano existe
        if(empty(self::getPlanById($request['id_plano']))) {
            return response()->json(['error' => 'Plan not found'], 400);
        }

        // Verifica se o usuario existe
        if(empty(UserService::getUserById($request['id_usuario']))) {
            return response()->json(['error' => 'User not found'], 400);
        }

        // Retorna os parametros que deram erro caso algum nao seja preenchido ou nao esteja dentro dos requisitos
        if($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }

        return PlanRepository::attributePlan($request);
    }


    /**
     * Service responsavel por listar todos planos de um usuário
     * @author douglas 
    */
    public static function listPlansUser($id) {
        // Verifica se o usuario existe
        if(empty(UserService::getUserById($id))) {
            return response()->json(['error' => 'User not found'], 400);
        }

        return PlanRepository::verifyPlanUser($id);
    }


    /**
     * Service responsavel por atribuir um plano a um usuario
     * @author douglas 
    */
    public static function rmPlanOfUser($request) {
        // Verifica se todos parametros obrigatorios foram preenchidos
        $validator = Validator::make($request, [
            'id_plano' => 'int|required',
            'id_usuario' => 'int|required'
        ],
        [
            'required' => 'O :attribute é obrigatório.',
        ]);

        // Verifica se o plano existe
        if(empty(self::getPlanById($request['id_plano']))) {
            return response()->json(['error' => 'Plan not found'], 400);
        }

        // Verifica se o usuario existe
        if(empty(UserService::getUserById($request['id_usuario']))) {
            return response()->json(['error' => 'User not found'], 400);
        }

        // Retorna os parametros que deram erro caso algum nao seja preenchido ou nao esteja dentro dos requisitos
        if($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }

        return PlanRepository::removeUserofPlan($request);
    }
    
}