<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class PlanModel extends Model
{

    /**
     * Model repsonsavel por pesquisar um plano especifico no banco de dados
     * @author douglas
    */
    public function getPlanDB($id) 
    {   
        try {
            return DB::table('planos')
                ->where('id', '=', $id)
                ->get()
                ->toArray();
        } catch (QueryException $e) {
            return null;
        }
    }


    /**
     * Insere um novo plano no banco de dados
     * @author douglas
    */
    public function createPlanDB($fields) {
        try {
            DB::table('planos')
                ->insert($fields);
            return true;

        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }



    /**
     * Atualiza um plano no banco de dados
     * @author douglas
    */
    public function uptPlanDB($id, $fields) {
        try {
            DB::table('planos')
                ->where('id', '=', $id)
                    ->update($fields);

            return true;
        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }


    /**
     * Deleta um novo plano no banco de dados
     * @author douglas
    */
    public function delPlanDB($id) {
        try {
            DB::table('planos')
                ->where('id', '=', $id)
                    ->delete();

            return true;
        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }


    /**
     * Atribui um plano a um usuário
     * @author douglas
    */
    public function attrPlanDB($fields) {
        
        try {
            // Verifica se o usuário já pertence a este plano
            $s = DB::table('assinaturas')
                ->where('id_usuario', '=', $fields['id_usuario'])
                ->where('id_plano', '=', $fields['id_plano'])
                ->get()
                ->toArray();
    
            if(empty($s)) {
                // Seta o horario atual na contratação do plano
                $fields['data_contratacao'] = Carbon::now();

                DB::table('assinaturas')
                    ->insert($fields);
    
                return true;
            }

            return 'User already belongs to this plan';
        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }


    /**
     * Lista planos de um usuário
     * @author douglas
    */
    public function listPlanUserDB($id) {
        
        try {
            // Retorna todas informações do plano
            return DB::table('assinaturas')
                ->join('members', 'assinaturas.id_usuario', '=', 'members.id')
                ->join('planos', 'assinaturas.id_plano', '=', 'planos.id')
                ->select('planos.nome_plano', 'planos.periodo_plano', 'assinaturas.data_contratacao', 
                    DB::raw("date_add(assinaturas.data_contratacao, INTERVAL planos.periodo_plano DAY) as data_expiracao"), 
                    DB::raw("IF(date_add(assinaturas.data_contratacao, INTERVAL planos.periodo_plano DAY) >= NOW(), 'Ativo', 'Expirado') AS status"))
                ->where('assinaturas.id_usuario', '=', $id)
                ->get()
                ->toArray();
        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }


    /**
     * Model para remover um plano de um usuário
     * @author douglas
    */
    public function rmPlanOfUserDB($fields) 
    {
        try {
            $s = DB::table('assinaturas')
                ->where('id_usuario', '=', $fields['id_usuario'])
                ->where('id_plano', '=', $fields['id_plano'])
                ->get()
                ->toArray();
                
            if(empty($s)) {
                return 'User does not belong to this plan';
            }
            
            DB::table('assinaturas')
                ->where('id_usuario', '=', $fields['id_usuario'])
                ->where('id_plano', '=', $fields['id_plano'])
                ->delete();

            return true;
        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }
}
