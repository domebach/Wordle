<template>
    <div class="text-white text-2xl m-2 w-12 h-12 bg-stone-800 opacity-80">
        <input v-model="letter" :ref="$vnode.key" maxlength="1" type="text" :class="inputClasses" :disabled="! $parent.active || $parent.submitted"
               class="w-full h-full border text-center" @input="onInput"  @keydown.enter="onEnter">
    </div>
</template>

<script>
    export default {
        data() {
            return {
                letter: '',
                status: 0,
            };
        },
        computed: {
            inputClasses() {
                return {
                    'border-white': this.$parent.active,
                    'border-gray-600': !this.$parent.active,
                    'bg-transparent': this.status == 0,
                    'bg-yellow-600': this.status == 1,
                    'bg-green-400': this.status == 2,
                }
            }
        },
        methods: {
            onInput() {
                // focus next
                this.$parent.$parent.focusElement(this.getNextKey());
                this.letter = this.letter.toUpperCase();
            },

            onEnter() {
                this.$parent.submit();
            },

            getNextKey() {
                let currentKey = parseInt(this.$vnode.key);
                let nextKey = currentKey + 1;

                if (nextKey > 5) {
                    nextKey = currentKey + 10;
                }
                if (nextKey > 50) {
                    return '';
                }

                return '' + nextKey;
            },
        }
    }
</script>
