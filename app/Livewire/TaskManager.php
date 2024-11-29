<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On; 
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TaskManager extends Component
{
    use WithPagination;

    #[Url]
    public $filter = 'all';
    public $title; // Título da nova tarefa
    public $priority = 'medium'; // Prioridade padrão
    public $editingTaskId = null;
    public $editingTaskTitle = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'priority' => 'required|in:low,medium,high',
    ];

    //Atualizar as Tasks ******************
    #[On('taskDeleted', 'taskUpdated')]
    public function refreshTasks()
    {
        logger('refreshTasks chamado no TaskManager');
        $this->resetPage(); // Reseta a paginação
        // $this->dispatch('$refresh'); // Força a recarga do componente
    }

    #[Url]
    public function updatingFilter()
    {
        $this->resetPage();
    }

    //Adicionar uma nova tarefa  **********************
    public function addTask()
    {
        // Validar título da tarefa
        $this->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
        ]);

        //Criar uma nova tarefa
        Task::create([
            'title' => $this->title,
            'priority' => $this->priority,
        ]);

        //Atualizar a lista de tarefas e limpar o campo
        $this->title = '';
        $this->priority = 'medium';
    }

    // Filtrar as tarefas \\\\\\\\\\\\\\\\\\\\\\\
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }
    
    private function getFilteredTasks()
    {
        $tasksQuery = Task::query();

        if ($this->filter !== 'all') {
            $tasksQuery->where('completed', $this->filter === 'completed');
        }

        return $tasksQuery->orderBy('created_at', 'desc')->paginate(5);
    }

    public function render()
    {
        return view('livewire.task-manager', [
            'tasks' => $this->getFilteredTasks(),
        ]);
    }
}
