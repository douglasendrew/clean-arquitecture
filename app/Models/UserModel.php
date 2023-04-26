<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{

    /**
     * Busca o usuario no banco de dados pelo ID
     * @author douglas
     */
    public function getUserById($id)
    {
        try {
            return DB::table('members')
                ->where('id', '=', $id)
                ->get()
                ->toArray();
        } catch (QueryException $e) {
            return null;
        }
    }


    /**
     * Insere um usuario no banco de dados
     * @author douglas
     */
    public function createUser($fields)
    {
        try {
            DB::table('members')
                ->insert($fields);

            return true;
        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }


    /**
     * Atualiza um usuario no banco de dados
     * @author douglas
     */
    public function updateUser($id, $fields)
    {
        try {
            DB::table('members')
                ->where('id', '=', $id)
                ->update($fields);

            return true;
        } catch (QueryException $e) {

            return $e->errorInfo[2];
        }
    }


    /**
     * Deleta um usuario no banco de dados
     * @author douglas
     */
    public function deleteUser($id)
    {
        try {
            DB::table('members')
                ->where('id', '=', $id)
                ->delete();

            return true;
        } catch (QueryException $e) {

            return $e->errorInfo[2];
        }
    }


    /**
     * Deleta um usuario no banco de dados
     * @author douglas
     */
    public function listMembers()
    {
        try {
            return DB::table('members')
                ->get()
                ->toArray();
        } catch (QueryException $e) {

            return $e->errorInfo[2];
        }
    }
}
