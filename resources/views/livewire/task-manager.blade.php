<div class="relative px-6 pt-10 pb-8 text-black bg-white shadow-xl dark:bg-gray-900 dark:text-white ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
    <!-- Componente de Notificação -->
    <div>
        <livewire:notification />
    </div>
    <h1 class="mb-4 font-bold text-2x1">Gerenciador de Tarefas</h1>

    <div class="flex mb-4 space-x-4 text-black">
        <!-- Filtros -->
        <button
            wire:click="setFilter('all')"
            class="px-4 py-2 {{ $filter === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200' }} rounded"
        >
            Todas
        </button>
        <button
            wire:click="setFilter('pending')"
            class="px-4 py-2 {{ $filter === 'pending' ? 'bg-blue-500 text-white' : 'bg-gray-200' }} rounded"
        >
            Pendentes
        </button>
        <button
            wire:click="setFilter('completed')"
            class="px-4 py-2 {{ $filter === 'completed' ? 'bg-blue-500 text-white' : 'bg-gray-200' }} rounded"
        >
            Concluídas
        </button>
    </div>

    <form wire:submit.prevent="addTask" class="mb-4" method="POST">
        @csrf
        <input
            type="text"
            wire:model='title'
            class="w-full p-2 mb-2 text-black border rounded dark:bg-gray-900 dark:text-white"
            placeholder="Nova Tarefa"
        />
        <select wire:model="priority" class="w-full p-2 mb-2 border rounded dark:bg-gray-900 dark:text-white">
            <option value="low">Baixa</option>
            <option value="medium">Média</option>
            <option value="high">Alta</option>
        </select>
        @error('priority') <span class="text-red-500">{{ $message }}</span> @enderror
        @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Adicionar</button>
    </form>

    <ul>
        @foreach($tasks as $task)
            <livewire:components.task-item 
                :task="$task"
                :editingTaskId="$editingTaskId"
                :editingTaskTitle="$editingTaskTitle"
                wire:key="task-{{ $task->id }}"
            />
        @endforeach
    </ul> 
    <div class="justify-center mt-4">
            {{ $tasks->links('pagination::tailwind') }}
    </div>
</div>
