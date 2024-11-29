<?php

namespace App\Livewire\Components;

use Livewire;
use App\Models\Task;
use Livewire\Component;

class TaskItem extends Component
{
    public Task $task;
    public $editingTaskId = null;
    public $editingTaskTitle = '';

    protected $rules = [
        'editingTaskTitle' =>'required|string|max:255',
    ];

    //Edição do título \\\\\\\\\\\\\\\\\\\\\\\\\\
    public function startEditing($id, $title)
    {
        $this->editingTaskId = $id;
        $this->editingTaskTitle = $title;
    }

    public function saveTaskTitle($id)
    {
        // Validar título
        $this->validate();

        // Atualizar o título da tarefa
        $task = Task::find($id);
        $task->title = $this->editingTaskTitle;
        $task->save();

        // Resetar os campos de edição
        $this->editingTaskId = null;
        $this->editingTaskTitle = '';

        // logger('Evento taskUpdated disparado pelo TaskItem');
        // atualizar a lista de tarefas
        // $this->dispatch('taskUpdated');
        return redirect(request()->header('Referer'));

        $this->dispatch('notify', ['message' => 'Tarefa atualizada com sucesso!', 'type' => 'success']);
    }

    public function cancelEditing()
    {
        $this->editingTaskId = null;
        $this->editingTaskTitle = '';
    }

    public function toggleCompletion()
    {
        $this->task->completed = !$this->task->completed;
        $this->task->save();
    }

    public function deleteTask()
    {
        $this->task->delete(); // Exclui a tarefa
        $this->dispatch('taskDeleted'); // Notifica o componente pai
        $this->dispatch('notify', ['message' => 'Tarefa excluída com sucesso!', 'type' => 'success']);
        // $this->dispatch('notify', ['message' => 'Erro ao excluir a tarefa.','type' => 'error',]);

    }
    
    public function render()
    {
        return view('livewire.components.task-item');
    }
}
