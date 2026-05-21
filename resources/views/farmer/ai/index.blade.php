<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">AI advisory</span>
            <div>
                <h1 class="page-title">Agronomist AI chat</h1>
                <p class="page-subtitle">Ask crop questions, weather timing questions, or upload a field image for guided analysis.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container" x-data="chatBot()">
        <div class="grid gap-6 xl:grid-cols-[0.36fr_0.64fr]">
            <div class="panel">
                <span class="section-badge">How to use</span>
                <h2 class="mt-5 text-3xl font-semibold">Ask like you are briefing an advisor.</h2>
                <p class="mt-4 text-sm leading-7 text-muted">
                    Include crop type, timing, symptoms, weather concerns, or price questions. You can also attach an image for crop analysis.
                </p>

                <div class="mt-8 space-y-4">
                    <button @click="sendPrompt('Is it safe to spray pesticide this Wednesday?')" class="btn-secondary w-full justify-start">
                        Weather and pesticide timing
                    </button>
                    <button @click="sendPrompt('Should I hold my Wheat harvest for better mandi prices?')" class="btn-secondary w-full justify-start">
                        Mandi timing advice
                    </button>
                    <button @click="sendPrompt('What crop rotation is best for black soil?')" class="btn-secondary w-full justify-start">
                        Crop rotation planning
                    </button>
                </div>
            </div>

            <div class="panel-strong flex min-h-[42rem] flex-col overflow-hidden">
                <div id="chatBox" class="flex-1 space-y-5 overflow-y-auto pb-6">
                    <div class="max-w-[88%] rounded-[1.4rem] border border-[rgba(45,124,75,0.16)] bg-[rgba(220,233,222,0.55)] px-5 py-4 text-sm leading-7 text-[color:var(--ink)]">
                        Hello <span class="font-bold">{{ auth()->user()->name }}</span>. I am your AgriTrek agronomist assistant. Ask about crops, timing, weather, pricing, or upload an image when needed.
                    </div>

                    <template x-for="(msg, index) in messages" :key="index">
                        <div class="flex" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">
                            <div class="max-w-[88%] rounded-[1.4rem] px-5 py-4 text-sm leading-7 shadow-sm"
                                 :class="msg.role === 'user' ? 'bg-[linear-gradient(135deg,#2d7c4b,#1d5d38)] text-white' : 'border border-[rgba(25,52,42,0.09)] bg-white/80 text-[color:var(--ink)]'">
                                <template x-if="msg.image">
                                    <img :src="msg.image" alt="Uploaded crop image" class="mb-3 max-h-48 rounded-[1rem] border border-white/20 object-cover">
                                </template>
                                <span x-text="msg.content"></span>
                            </div>
                        </div>
                    </template>

                    <div x-show="loading" class="w-fit rounded-[1.4rem] border border-[rgba(25,52,42,0.09)] bg-white/80 px-5 py-4 text-sm text-muted">
                        AgriTrek is preparing a response...
                    </div>
                </div>

                <div class="border-t border-[color:var(--line)] pt-5">
                    <div x-show="imagePreview" class="mb-4 flex items-center justify-between gap-3 rounded-[1.3rem] border border-[rgba(45,124,75,0.14)] bg-[rgba(220,233,222,0.38)] p-3">
                        <div class="flex min-w-0 items-center gap-3">
                            <img :src="imagePreview" alt="Selected crop image" class="h-14 w-14 rounded-[0.9rem] object-cover">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-semibold text-[color:var(--ink)]" x-text="imageName"></p>
                                <p class="text-xs text-muted">Ready for crop image analysis</p>
                            </div>
                        </div>
                        <button type="button" @click="clearImage" class="btn-secondary">Remove</button>
                    </div>

                    <form @submit.prevent="sendMessage" class="flex flex-col gap-3 sm:flex-row sm:items-end">
                        <label class="btn-secondary cursor-pointer">
                            <input type="file" accept="image/*" class="hidden" @change="handleImage">
                            Attach Image
                        </label>

                        <div class="flex-1">
                            <input x-model="userInput" type="text" placeholder="Ask your agronomist assistant..." class="field-input w-full">
                        </div>

                        <button type="submit" :disabled="loading || (!userInput.trim() && !imageFile)" class="btn-primary disabled:cursor-not-allowed disabled:opacity-50">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                    .catch(() => {
                        this.messages.push({ role: 'ai', content: 'Connection issue. Please try again later.' });
                        this.loading = false;
                        this.scrollToBottom();
                    });
                },
                scrollToBottom() {
                    setTimeout(() => {
                        const cb = document.getElementById('chatBox');
                        if (cb) cb.scrollTop = cb.scrollHeight;
                    }, 50);
                }
            }
        }
    </script>
</x-app-layout>
