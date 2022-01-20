<template>
    <div class="flex justify-center w-full">
        <letter-box v-for="childIndex in 5" :key="$vnode.key + '' + childIndex"/>
    </div>
</template>

<script>
    import LetterBox from './LetterBox.vue'

    export default {
        components: {
            'letter-box': LetterBox
        },
        data() {
            return {
                active: false,
                submitted: false,
            };
        },
        methods: {
            submit() {
                if (! this.active || this.submitted) {
                    return null;
                }

                let word = '';

                this.$children.forEach(child => {
                    word += child.letter.toUpperCase();
                })

                if (word.length < 5) {
                    return null;
                }

                this.submitted = true;

                let response = this.$parent.submit(word.normalize());
                response.forEach((status, index) => {
                    this.$children[index].status = status;
                })
            }
        }
    }
</script>
