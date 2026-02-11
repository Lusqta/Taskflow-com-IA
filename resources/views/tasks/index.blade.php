<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow IA - Liquid Glass</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: url("{{ asset('img/taskflow-bg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }
        
        .glass {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
        }

        .glass-input {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .glass-input:focus {
            background: rgba(0, 0, 0, 0.4);
            border-color: rgba(255, 255, 255, 0.3);
            outline: none;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1); 
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2); 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3); 
        }

        /* Adicionado para fluidez: transições suaves nos cards */
        .task-card {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        }
    </style>
</head>
<body class="min-h-screen text-white flex flex-col items-center py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="glass w-full max-w-7xl rounded-2xl p-6 mb-8 flex justify-between items-center sm:flex-row flex-col gap-4">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-white/10 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-white drop-shadow-md">Taskflow com IA</h1>
                <p class="text-blue-200 text-sm font-medium"></p>
            </div>
        </div>
        
        <!-- Add Task Form -->
        <form action="{{ route('tasks.store') }}" method="POST" class="flex w-full sm:w-auto gap-2 flex-col lg:flex-row items-center">
            @csrf
            <input type="text" name="title" placeholder="Nova tarefa..." class="glass-input px-4 py-2 rounded-lg placeholder-gray-300 w-full sm:w-64 transition-all" required>
            <input type="text" name="description" placeholder="Detalhes..." class="glass-input px-4 py-2 rounded-lg placeholder-gray-300 w-full sm:w-64 transition-all">
            <select name="priority" class="glass-input px-4 py-2 rounded-lg bg-gray-900/50 text-white w-full sm:w-32 transition-all cursor-pointer">
                <option value="low">Baixa</option>
                <option value="medium" selected>Média</option>
                <option value="high">Alta</option>
            </select>
            <button type="submit" class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transform transition hover:scale-105 active:scale-95 border border-white/20 whitespace-nowrap">
                + Adicionar
            </button>
        </form>
    </div>

    <!-- IA Insights & Actions -->
    <div class="w-full max-w-7xl mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
        @if(session('insight'))
            <div class="flex-1 glass bg-orange-500/20 border-orange-400/30 p-4 rounded-xl flex items-center gap-4 animate-pulse">
                <div class="p-2 bg-orange-500 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-orange-300">IA Productivity Insight</h4>
                    <p class="text-sm text-orange-100 font-medium italic">"{{ session('insight') }}"</p>
                </div>
            </div>
        @elseif(session('error'))
            <div class="flex-1 glass bg-red-500/20 border-red-400/30 p-4 rounded-xl flex items-center gap-4">
                <div class="p-2 bg-red-500 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-red-300">Erro na IA</h4>
                    <p class="text-sm text-red-100 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @else
            <div class="flex-1"></div>
        @endif

        <form action="{{ route('tasks.reorganize') }}" method="POST">
            @csrf
            <button type="submit" class="group flex items-center gap-3 bg-white/10 hover:bg-white/20 border border-white/20 px-6 py-3 rounded-xl transition-all hover:scale-105 active:scale-95 shadow-xl">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                </span>
                <span class="font-bold text-sm tracking-wide text-white">Deixar a IA organizar</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-300 group-hover:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
            </button>
        </form>
    </div>

    <!-- Kanban Board -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-7xl h-full flex-1">
        
        @php
            $columns = [
                'todo' => ['label' => 'A Fazer', 'color' => 'bg-yellow-400', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                'doing' => ['label' => 'Em Progresso', 'color' => 'bg-orange-400', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                'done' => ['label' => 'Concluído', 'color' => 'bg-green-400', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']
            ];
        @endphp

        @foreach($columns as $status => $col)
            <div class="glass rounded-2xl flex flex-col h-full min-h-[600px] overflow-hidden" data-status="{{ $status }}">
                <!-- Column Header -->
                <div class="p-5 border-b border-white/10 flex items-center justify-between bg-black/10">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-white/5 rounded-lg border border-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $col['icon'] }}" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-white tracking-wide">{{ $col['label'] }}</h2>
                    </div>
                    <span class="task-count bg-white/20 text-xs font-bold px-2.5 py-1 rounded-full text-white">{{ $tasks->where('status', $status)->count() }}</span>
                </div>

                <!-- Column Body (Sortable container) -->
                <div class="p-4 flex-1 overflow-y-auto space-y-4 custom-scrollbar">
                    @foreach($tasks->where('status', $status) as $task)
                        <div class="group relative bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/30 rounded-xl p-4 transition-all duration-300 cursor-default select-none task-card" data-id="{{ $task->id }}">
                            
                            <!-- BOTÃO DE ARRASTAR (grip) - canto superior esquerdo -->
                            <div class="handle absolute left-0 top-0 bottom-0 w-10 flex items-center justify-center opacity-40 group-hover:opacity-100 transition-opacity cursor-grab active:cursor-grabbing z-30">
                                <div class="p-1 rounded-md hover:bg-white/10 transition-colors">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <circle cx="9" cy="8" r="1.5"/>
                                        <circle cx="15" cy="8" r="1.5"/>
                                        <circle cx="9" cy="12" r="1.5"/>
                                        <circle cx="15" cy="12" r="1.5"/>
                                        <circle cx="9" cy="16" r="1.5"/>
                                        <circle cx="15" cy="16" r="1.5"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Priority Badge -->
                            <div class="absolute top-4 right-4">
                                @if($task->priority == 'high')
                                    <span class="bg-red-500/80 text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider shadow-sm backdrop-blur-sm">Alta</span>
                                @elseif($task->priority == 'medium')
                                    <span class="bg-yellow-500/80 text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider shadow-sm backdrop-blur-sm">Média</span>
                                @else
                                    <span class="bg-green-500/80 text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider shadow-sm backdrop-blur-sm">Baixa</span>
                                @endif
                            </div>

                            <!-- Conteúdo do card -->
                            <div class="pl-10">
                                <h3 class="font-bold text-white text-lg pr-12">{{ $task->title }}</h3>
                                <p class="text-white text-sm mt-2 leading-relaxed font-medium">{{ $task->description ?: 'Sem descrição detalhada.' }}</p>

                                <div class="mt-4 pt-3 border-t border-white/10 flex justify-between items-center">
                                    <span class="text-xs text-gray-200 font-mono font-semibold">{{ $task->created_at->format('d/m H:i') }}</span>
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                                        <button onclick="openEditModal(JSON.parse(this.getAttribute('data-task')))" data-task="{{ $task }}" class="text-gray-400 hover:text-white transition p-1 hover:bg-white/10 rounded" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir esta tarefa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition p-1 hover:bg-white/10 rounded" title="Excluir">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Footer -->
    <footer class="mt-12 text-center text-gray-100 text-sm glass px-6 py-2 rounded-full">
        <p>&copy; {{ date('Y') }} TaskFlow IA &bull; Feito com Laravel & Tailwind &bull; Liquid Glass UI </p>
    </footer>

    <!-- Edit Task Modal -->
    <div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity">
        <div class="glass rounded-2xl p-8 max-w-2xl w-full mx-4 relative shadow-2xl transform transition-all">
            <button onclick="closeEditModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">✕</button>
            <h2 class="text-2xl font-bold mb-6 text-white border-b border-white/10 pb-2">Editar Tarefa</h2>
            
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId">
                
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-gray-200 mb-1 font-semibold">Título</label>
                        <input type="text" name="title" id="editTitle" class="glass-input w-full px-4 py-2 rounded-lg focus:ring-2 focus:ring-orange-500/50 transition-all" required>
                    </div>
                    
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-gray-200 mb-1 font-semibold">Descrição</label>
                        <textarea name="description" id="editDescription" class="glass-input w-full px-4 py-2 rounded-lg h-24 focus:ring-2 focus:ring-orange-500/50 transition-all"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-gray-200 mb-1 font-semibold">Prioridade</label>
                        <select name="priority" id="editPriority" class="glass-input w-full px-4 py-2 rounded-lg bg-gray-900/50 text-white focus:ring-2 focus:ring-orange-500/50 transition-all">
                            <option value="low">Baixa</option>
                            <option value="medium">Média</option>
                            <option value="high">Alta</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-300 hover:text-white transition text-sm font-medium">Cancelar</button>
                        <button type="submit" class="bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-500 hover:to-orange-500 text-white font-bold px-6 py-2 rounded-lg shadow-lg transition transform hover:scale-105 active:scale-95">Salvar Alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Drag & Drop Logic
            const columns = document.querySelectorAll('.custom-scrollbar');
            
            columns.forEach(col => {
                new Sortable(col, {
                    group: {
                        name: 'kanban',
                        pull: true,
                        put: true
                    },
                    handle: '.handle',
                    animation: 250, 
                    easing: 'cubic-bezier(0.4, 0, 0.2, 1)',
                    ghostClass: 'bg-indigo-500/20',
                    chosenClass: 'scale-[1.02]',
                    dragClass: 'opacity-90',
                    fallbackOnBody: true,
                    swapThreshold: 0.65,
                    
                    onEnd: function (evt) {
                        const item = evt.item;
                        const newStatus = evt.to.closest('[data-status]').dataset.status;
                        const taskId = item.dataset.id;

                        if (!newStatus || (evt.from === evt.to && evt.oldIndex === evt.newIndex)) return;

                        // Local Optimistic Update for Counters
                        const fromContainer = evt.from.closest('[data-status]');
                        const toContainer = evt.to.closest('[data-status]');
                        
                        // Select the counter span - we added the class .task-count
                        const fromCountEl = fromContainer.querySelector('.task-count');
                        const toCountEl = toContainer.querySelector('.task-count');

                        if (fromCountEl && toCountEl) {
                            let fromCount = parseInt(fromCountEl.innerText);
                            let toCount = parseInt(toCountEl.innerText);
                            
                            fromCountEl.innerText = Math.max(0, fromCount - 1);
                            toCountEl.innerText = toCount + 1;
                        }

                        fetch(`/tasks/${taskId}/move`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ status: newStatus })
                        }).then(res => {
                            if (!res.ok) {
                                throw new Error('Network response was not ok');
                            }
                            console.log('Task moved to:', newStatus);
                        }).catch(err => {
                            console.error('Error:', err);
                            // Revert move on error
                            evt.from.insertBefore(item, evt.from.children[evt.oldIndex]);
                            // Revert counters
                             if (fromCountEl && toCountEl) {
                                let fromCount = parseInt(fromCountEl.innerText);
                                let toCount = parseInt(toCountEl.innerText);
                                fromCountEl.innerText = fromCount + 1;
                                toCountEl.innerText = Math.max(0, toCount - 1);
                            }
                        });
                    }
                });
            });

            // Modal Functions
            window.openEditModal = function(task) {
                const modal = document.getElementById('editModal');
                modal.classList.remove('hidden');
                
                document.getElementById('editId').value = task.id;
                document.getElementById('editTitle').value = task.title;
                document.getElementById('editDescription').value = task.description || '';
                document.getElementById('editPriority').value = task.priority;
                document.getElementById('editForm').action = `/tasks/${task.id}`;
            }

            window.closeEditModal = function() {
                document.getElementById('editModal').classList.add('hidden');
            }
        });
    </script>
</body>
</html>