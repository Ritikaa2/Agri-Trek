<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-purple-500/20 text-purple-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
                {{ __('AI Agronomist Chat') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 flex-1 flex flex-col h-[calc(100vh-140px)]" x-data="chatBot()">
        <div class="max-w-4xl mx-auto w-full px-4 sm:px-6 lg:px-8 flex-1 flex flex-col relative">
            
            <div class="flex-1 bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl shadow-2xl flex flex-col overflow-hidden relative z-10 shadow-purple-500/10">
                
                <!-- Chat Messages Area -->
                <div id="chatBox" class="flex-1 overflow-y-auto p-6 sm:p-8 space-y-6 flex flex-col scroll-smooth">
                    
                    <!-- Welcome Message -->
                    <div class="flex items-start gap-4 max-w-[85%]">
                        <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/50 flex-shrink-0 flex items-center justify-center text-purple-600 dark:text-purple-400 mt-1 shadow-sm border border-purple-200 dark:border-purple-800/50">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div class="bg-gray-50 dark:bg-[#0d1310] border border-gray-100 dark:border-gray-800 rounded-2xl rounded-tl-sm px-5 py-3.5 text-gray-800 dark:text-gray-200 shadow-sm leading-relaxed text-[15px]">
                            Hello <span class="font-bold">{{ auth()->user()->name }}</span>! I am your AI Agronomist for Agri-Trek. I've analyzed your land profiles. How can I assist you with your farming today?
                        </div>
                    </div>

                    <!-- Iterated Messages -->
                    <template x-for="(msg, index) in messages" :key="index">
                        <div class="flex items-start gap-4 transition-all" :class="msg.role === 'user' ? 'justify-end' : 'max-w-[85%]'">
                            <!-- AI Avatar -->
                            <template x-if="msg.role === 'ai'">
                                <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/50 flex-shrink-0 flex items-center justify-center text-purple-600 dark:text-purple-400 mt-1 shadow-sm border border-purple-200 dark:border-purple-800/50">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                            </template>

                            <!-- Message Content -->
                            <div class="px-5 py-3.5 text-[15px] leading-relaxed shadow-sm max-w-[85%]"
                                 :class="msg.role === 'user' ? 'bg-emerald-600 text-white rounded-2xl rounded-tr-sm order-1' : 'bg-gray-50 dark:bg-[#0d1310] border border-gray-100 dark:border-gray-800 rounded-2xl rounded-tl-sm text-gray-800 dark:text-gray-200'">
                                <template x-if="msg.image">
                                    <img :src="msg.image" alt="Uploaded crop image" class="mb-3 max-h-48 rounded-xl border border-white/20 object-cover">
                                </template>
                                <span x-text="msg.content"></span>
                            </div>

                            <!-- User Avatar -->
                            <template x-if="msg.role === 'user'">
                                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex-shrink-0 flex items-center justify-center order-2 mt-1 shadow-sm overflow-hidden border border-gray-300 dark:border-gray-600">
                                     <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff&bold=true" alt="Avatar">
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Loading Indicator -->
                    <div x-show="loading" class="flex items-start gap-4 max-w-[85%] animate-pulse">
                        <div class="w-10 h-10 rounded-full bg-purple-100/50 dark:bg-purple-900/30 flex-shrink-0"></div>
                        <div class="bg-gray-50/80 dark:bg-[#0d1310]/80 border border-gray-100 dark:border-gray-800 rounded-2xl rounded-tl-sm px-5 py-4 flex items-center gap-1.5">
                            <div class="w-1.5 h-1.5 bg-purple-400 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                            <div class="w-1.5 h-1.5 bg-purple-400 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                            <div class="w-1.5 h-1.5 bg-purple-400 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="p-4 sm:p-6 bg-gray-50/50 dark:bg-[#0d1310]/80 border-t border-gray-100 dark:border-gray-800 mt-auto">
                    <!-- Suggested Prompts -->
                    <div class="flex gap-2 overflow-x-auto pb-4 scrollbar-hide" x-show="messages.length === 0">
                        <button @click="sendPrompt('Is it safe to spray pesticide this Wednesday?')" class="whitespace-nowrap px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm text-purple-600 dark:text-purple-400 rounded-full hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">🌦️ Weather & Pesticides</button>
                        <button @click="sendPrompt('Should I hold my Wheat harvest for better Mandi prices?')" class="whitespace-nowrap px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm text-purple-600 dark:text-purple-400 rounded-full hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">📈 Mandi Rates</button>
                        <button @click="sendPrompt('What crop rotation is best for Black soil?')" class="whitespace-nowrap px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm text-purple-600 dark:text-purple-400 rounded-full hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">🌱 Crop Rotation</button>
                    </div>

                    <div x-show="imagePreview" class="mb-3 flex items-center justify-between gap-3 rounded-2xl border border-purple-200 bg-purple-50 p-3 dark:border-purple-900/50 dark:bg-purple-950/20">
                        <div class="flex items-center gap-3 min-w-0">
                            <img :src="imagePreview" alt="Selected crop image" class="h-14 w-14 rounded-xl object-cover">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-bold text-gray-800 dark:text-gray-100" x-text="imageName"></p>
                                <p class="text-xs text-gray-500">Ready for crop image analysis</p>
                            </div>
                        </div>
                        <button type="button" @click="clearImage" class="shrink-0 rounded-xl bg-white px-3 py-2 text-xs font-bold text-gray-600 shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">Remove</button>
                    </div>

                    <form @submit.prevent="sendMessage" class="relative flex items-center gap-3">
                        <label class="shrink-0 w-12 h-12 bg-white dark:bg-gray-900/50 border border-gray-200 dark:border-gray-800 text-purple-600 dark:text-purple-400 rounded-2xl shadow-inner flex items-center justify-center cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors" title="Upload crop image">
                            <input type="file" accept="image/*" class="hidden" @change="handleImage">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </label>
                        <input x-model="userInput" type="text" placeholder="Ask your AI Agronomist or attach crop image..." class="w-full bg-white dark:bg-gray-900/50 border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-2xl py-4 pl-6 pr-16 shadow-inner focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                        
                        <button type="submit" :disabled="loading || (!userInput.trim() && !imageFile)" class="absolute right-2 w-10 h-10 bg-purple-600 hover:bg-purple-500 disabled:bg-gray-300 dark:disabled:bg-gray-700 rounded-xl text-white flex items-center justify-center transition-transform hover:scale-105 active:scale-95 disabled:scale-100 disabled:cursor-not-allowed">
                            <svg class="w-5 h-5 -ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </form>
                </div>
                
            </div>
            
            <div class="absolute -right-32 top-32 w-96 h-96 bg-purple-500/10 blur-[100px] rounded-full pointer-events-none"></div>
            <div class="absolute -left-32 bottom-32 w-96 h-96 bg-emerald-500/10 blur-[100px] rounded-full pointer-events-none"></div>

        </div>
    </div>

    <!-- Alpine.js logic built-in to the blade file for ease -->
    <script>
        function chatBot() {
            return {
                userInput: '',
                messages: [],
                loading: false,
                imageFile: null,
                imagePreview: '',
                imageName: '',
                sendPrompt(text) {
                    this.userInput = text;
                    this.sendMessage();
                },
                handleImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    this.imageFile = file;
                    this.imageName = file.name;
                    this.imagePreview = URL.createObjectURL(file);
                    event.target.value = '';
                },
                clearImage() {
                    if (this.imagePreview) URL.revokeObjectURL(this.imagePreview);
                    this.imageFile = null;
                    this.imagePreview = '';
                    this.imageName = '';
                },
                sendMessage() {
                    const text = this.userInput.trim();
                    if (!text && !this.imageFile) return;

                    // Add user message
                    this.messages.push({ role: 'user', content: text || 'Please analyze this crop image.', image: this.imagePreview });
                    this.userInput = '';
                    this.loading = true;
                    this.scrollToBottom();

                    const formData = new FormData();
                    formData.append('message', text);
                    if (this.imageFile) formData.append('image', this.imageFile);
                    this.imageFile = null;
                    this.imagePreview = '';
                    this.imageName = '';

                    // Send to backend
                    fetch('{{ route('farmer.ai.chat') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.messages.push({ role: 'ai', content: data.reply });
                        this.loading = false;
                        this.scrollToBottom();
                    })
                    .catch(err => {
                        this.messages.push({ role: 'ai', content: 'Connection issue. Please try again later.' });
                        this.loading = false;
                        this.scrollToBottom();
                    });
                },
                scrollToBottom() {
                    setTimeout(() => {
                        const cb = document.getElementById('chatBox');
                        if(cb) cb.scrollTop = cb.scrollHeight;
                    }, 50);
                }
            }
        }
    </script>
</x-app-layout>
