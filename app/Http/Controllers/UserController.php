<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Controller responsável pela consulta de um usuário especifico
     * @author douglas
     */
    public function getUser($id_user)
    {
        return UserService::getUserById($id_user);
    }


    /**
     * Controller responsável pela a criação de um usuário
     * @author douglas
     */
    public function newUser(Request $request)
    {
        return UserService::createUser($request->all());
    }


    /**
     * Controller responsável pela atualização de um usuário
     * @author douglas
     */
    public function updtUser($id, Request $request)
    {
        return UserService::updateUser($id, $request->all());
    }


    /**
     * Controller responsável pela exclusão de um usuário
     * @author douglas
     */
    public function delUser($id)
    {
        return UserService::deleteUser($id);
    }


    /**
     * Controller responsável pela listagem de usuários
     * @author douglas
     */
    public function allUsers()
    {
        return UserService::listUsers();
    }
}
