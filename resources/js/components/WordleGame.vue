<template>
            <div>
                <letter-row v-for="index in 5" :key="index"/>

                <div class="text-white text-center mt-10">
                    <div v-if="tries > 0 && this.result === ''">Du hast noch {{ tries }} Versuche.</div>
                    <div v-else>
                        {{ result == 'victory' ? 'Du hast gewonnen!' : 'Leider nicht geschafft' }}
                    </div>
                </div>

                <div v-if="result == 'defeat'" style="letter-spacing: 4px;"
                     class="text-white text-center mt-10">
                    Gib über die Tastatur ein Wort ein<br>
                    und bestätige mit ENTER
                </div>

                <div v-if="result == 'defeat'" style="letter-spacing: 4px;"
                     class="w-full bg-stone-800 text-white text-lg font-bold text-center opacity-80 mt-6 p-2 rounded-lg">
                    {{ solutionWord.toUpperCase() }}
                </div>

                <button v-if="result !== ''" type="submit" @click="redirectToScoreboard()"
                        class="text-black font-bold bg-yellow-100 rounded-lg text-xl p-3 w-full text-center mt-6">
                    WEITER
                </button>
            </div>
</template>
<script>
    import LetterRow from './LetterRow.vue'

    export default {
        components: {
            'letter-row': LetterRow
        },
        props: {
            solutionWord: {
                type: String,
                required: true,
            },
            playername: {
                type: String,
                required: true,
            }
        },

        data() {
            return {
                tries: 5,
                result: '',
            };
        },

        mounted() {
            this.solutionWord = this.solutionWord.normalize();
            this.$children[0].active = true;
        },

        methods: {
            submit(word) {
                // game already over, do nothing
                if (this.tries === 0) {
                    return [];
                }
                return this.checkSolution(word)
            },

            redirectToScoreboard() {
                axios.post('/api/score', {username: this.playername, tries: this.tries})
                    .then(response => {
                        let res = response.data;
                        if (res.success) {
                            window.open(res.url, '_SELF');
                        }
                    })
            },

            checkSolution(word) {
                this.result = this.checkVictory(word);
                if (this.result !== 'victory') {
                    this.tries--;
                }
                this.result = this.checkDefeat();

                // check each letter
                let response = [];
                for (var i = 0; i < word.length; i++) {
                    response[i] = this.checkLetters(word.charAt(i), i);
                }

                if (this.result === '') {
                    this.activateNextRow();
                }

                return response;
            },

            checkVictory(word) {
                if (word == this.solutionWord || word.toLowerCase() == this.solutionWord.toLowerCase()) {
                    return 'victory';
                }
                return '';
            },

            checkDefeat() {
                if (this.tries === 0 && this.result === '') {
                    return 'defeat';
                }
                return this.result;
            },

            checkLetters(letter, position) {
                let response = 0;

                if (this.solutionWord.includes(letter) || this.solutionWord.includes(letter.toLowerCase())) {
                    response = 1;
                }

                if (this.solutionWord.charAt(position) == letter
                    || this.solutionWord.charAt(position) == letter.toLowerCase()) {
                    response = 2;
                }

                return response;
            },

            activateNextRow() {
                let activateChild = 0;
                this.$children.forEach((child, index) => {
                    if (child.active == true) {
                        child.active == false;
                        activateChild = index + 1;
                    }
                })

                if (activateChild >= this.$children.length) {
                    return;
                }

                this.$children[activateChild].active = true;
            },

            focusElement(key) {
                this.$children.forEach(child => {
                    child.$children.forEach(grandchild => {
                        if (grandchild.$refs[key]) {
                            grandchild.$refs[key].focus();
                        }
                    })
                })
            }
        }
    }
</script>
