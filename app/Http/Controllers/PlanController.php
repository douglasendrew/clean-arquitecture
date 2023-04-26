<?php

namespace App\Http\Controllers;

use App\Services\PlanService;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Controller responsavel por pesquisar/consultar um plano especifico
     * @author douglas
     */
    public function getPlano( $id ) {
        return PlanService::getPlanById($id);
    }


    /**
     * Controller responsavel por pesquisar/consultar um plano
     * @author douglas
    */
    public function newPlan( Request $request ) {
        return PlanService::createPlan($request->all());
    }


    /**
     * Controller responsavel por atualizar um plano
     * @author douglas
    */
    public function updatePlan( $id, Request $request ) {
        return PlanService::updtPlan($id, $request->all());
    }


    /**
     * Controller responsavel por deletar um plano
     * @author douglas
    */
    public function deletePlan( $id ) {
        return PlanService::delPlan($id);
    }


    /**
     * Controller responsavel por atribuir um plano a um usuário
     * @author douglas
    */
    public function attributePlan( Request $request ) {
        return PlanService::attrPlan($request->all());
    }


    /**
     * Controller responsavel por listar todos planos que um usuário faz parte
     * @author douglas
    */
    public function listPlan( $id ) {
        return PlanService::listPlansUser($id);
    }


    /**
     * Controller responsavel por remover um usuário de um plano
     * @author douglas
    */
    public function removeUser( Request $request ) {
        return PlanService::rmPlanOfUser($request->all());
    }
}
