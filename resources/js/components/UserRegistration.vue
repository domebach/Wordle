<template>
    <div class="flex flex-col w-full">
        <label for="username" class="text-white mb-5">Wer spielt?</label>
        <input v-model="username" type="text" name="username" placeholder="Dein Name" style="opacity: 0.7;"
               class="border border-slate-400 text-white text-xl bg-stone-700 mb-6 p-3">
        <button type="submit" @click="submit" class="text-black font-bold bg-yellow-100 rounded-lg text-3xl p-3">START</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                username: '',
            };
        },
        methods: {
            submit() {
                axios.post('/api/user-registration', {username: this.username})
                .then(response => {
                    let res = response.data;

                    if (res.success) {
                        window.open(res.url, '_SELF');
                    }
                });
            }
        }
    }
</script>
