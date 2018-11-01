<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;

class TaskController extends Controller
{
    /**
     * pegaUserOuCria
     *
     * @param  {string} $username
     *
     * @return {User}
     */
    public function pegaUserOuCria($username){
        $user = User::where('name', $username)->first();
        if(!filled($user)){
            $user = User::create([
                'name' => $username
            ]);

            //vamos criar algumas task para o user no primeiro acesso
            $user->tasks()->createMany([
                [
                    'descricao' => 'Aprender React'
                ],
                [
                    'descricao' => 'Terminar o rolê de marketing'
                ],
                [
                    'descricao' => 'Ligar para o cliente'
                ]
            ]);
        }

        return $user;
    }

    /**
     * Retorna todas as tasks do user
     *
     * @return \Illuminate\Http\Response
     * @param  string  $username
     */
    public function index(Request $request, $username)
    {
        $user = $this->pegaUserOuCria($username);

        return response()->json(['tarefas' => $user->tasks], 200);
    }

    /**
     * Guarda uma nova tarefa
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $username)
    {
        $user = $this->pegaUserOuCria($username);

        $user->tasks()->create([
            'descricao' => $request->descricao
        ]);

        return response()->json(['tarefas' => $user->tasks], 200);
    }

    /**
     * Completa ou descompleta uma task
     *
     * @param  string  $username
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function toggleCompletar(Request $request, $username, Task $task)
    {
        $user = $this->pegaUserOuCria($username);

        //checando o se eh dono da task
        if($user->id == $task->user_id){
            $task->completa = ($task->completa) ? 0 : 1;
            $task->save();
        }

        return response()->json(['tarefas' => $user->tasks], 200);
    }

    /**
     * Arquiva ou desarquiva uma task
     *
     * @param  string  $username
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function toggleArquivar(Request $request, $username, Task $task)
    {
        $user = $this->pegaUserOuCria($username);

        //checando o se eh dono da task
        if($user->id == $task->user_id){
            $task->arquivada = ($task->arquivada) ? 0 : 1;
            $task->save();
        }

        return response()->json(['tarefas' => $user->tasks], 200);
    }

    /**
     * Toggle da prioridade
     *
     * @param  string  $username
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function togglePrioridade(Request $request, $username, Task $task)
    {
        $user = $this->pegaUserOuCria($username);

        //checando o se eh dono da task
        if($user->id == $task->user_id){
            $task->prioridade = ($task->prioridade) ? 0 : 1;
            $task->save();
        }

        return response()->json(['tarefas' => $user->tasks], 200);
    }

}
