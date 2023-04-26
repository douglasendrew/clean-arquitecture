<?php

namespace App\Repositories;

use App\Models\PlanModel;

class PlanRepository
{

    /**
     * Repository responsavel pela consulta de um plano especifico
     * @author douglas 
     */
    public static function getPlanById($id)
    {
        $pm = new PlanModel();
        return $pm->getPlanDB($id);
    }


    /**
     * Repository responsavel pela consulta de um plano especifico
     * @author douglas 
     */
    public static function createPlan($fields)
    {
        $pm = new PlanModel();
        
        // Caso der tudo certo na execução da função, retorna com o boolean true 
        if ($new_plan = $pm->createPlanDB($fields) === true) {
            return response()->json(['success' => true, 'error' => null], 200);
        }

        return response()->json(['success' => false, 'error' => $new_plan], 400);
    }


    /**
     * Repository responsavel pela atualização de um plano especifico
     * @author douglas 
    */
    public static function updatePlan($id, $fields)
    {
        $pm = new PlanModel();
        
        // Caso der tudo certo na execução da função, retorna com o boolean true 
        if ($new_plan = $pm->uptPlanDB($id, $fields) === true) {
            return response()->json(['success' => true, 'error' => null], 200);
        }

        return response()->json(['success' => false, 'error' => $new_plan], 400);
    }

    /**
     * Repository responsavel pela atualização de um plano especifico
     * @author douglas 
    */
    public static function deletePlan($id)
    {
        $pm = new PlanModel();
        
        // Caso der tudo certo na execução da função, retorna com o boolean true 
        if ($new_plan = $pm->delPlanDB($id) === true) {
            return response()->json(['success' => true, 'error' => null], 200);
        }

        return response()->json(['success' => false, 'error' => $new_plan], 400);
    }


    /**
     * Repository responsavel por atribuir um plano a um usuario
     * @author douglas 
    */
    public static function attributePlan($fields)
    {
        $pm = new PlanModel();
        $attr_plan = $pm->attrPlanDB($fields);

        // Caso der tudo certo na execução da função, retorna com o boolean true 
        if ($attr_plan === true) {
            return response()->json(['success' => true, 'error' => null], 200);
        }

        return response()->json(['success' => false, 'error' => $attr_plan], 400);
    }


    /**
     * Repository responsavel verificar os planos de um usuário
     * @author douglas 
    */
    public static function verifyPlanUser($id)
    {
        $pm = new PlanModel();
        return $pm->listPlanUserDB($id);
    }


    /**
     * Repository responsavel por remover um usuário de um plano
     * @author douglas 
    */
    public static function removeUserofPlan($fields)
    {
        $pm = new PlanModel();
        $attr_plan = $pm->rmPlanOfUserDB($fields);

        // Caso der tudo certo na execução da função, retorna com o boolean true 
        if ($attr_plan === true) {
            return response()->json(['success' => true, 'error' => null], 200);
        }

        return response()->json(['success' => false, 'error' => $attr_plan], 400);
    }
}
