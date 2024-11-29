<div class="flex items-center justify-between pb-2 mb-2 border-b">
    
    <div class="flex-1 min-w-0">
       <!-- Campo de edição -->
       @if($editingTaskId === $task->id)
            <input
                type="text"
                wire:model="editingTaskTitle"
                wire:keydown.enter="saveTaskTitle({{ $task->id }})"
                wire:keydown.escape="cancelEditing"
                class="w-full p-1 mb-1 border rounded dark:bg-gray-900 dark:text-white"
            />
                @else
            <!-- Exibição do título -->
            <span
                class="cursor-pointer {{ $task->completed ? 'line-through text-gray-500' : '' }}"
                wire:click="startEditing({{ $task->id }}, '{{ $task->title }}')"
            >
                {{ $task->title }}
            </span>
        @endif
        <p class="text-sm text-gray-500">Prioridade: <strong>{{ ucfirst($task->priority) }}</strong></p>
    </div>

    <div class="flex flex-shrink-0 space-x-2">
        <button
            wire:click="toggleCompletion"
            class="px-2 py-1 text-white {{ $task->completed ? 'bg-yellow-500' : 'bg-green-500' }} rounded"
        >
            {{ $task->completed ? 'Reabrir' : 'Concluir' }}
        </button>

        <button
            wire:click="deleteTask"
            class="px-2 py-1 text-white bg-red-500 rounded"
        >
            Excluir
        </button>
    </div>
</div>

