<template>
    <div class="container flex justify-content-center">
        <div>
            <div class="flex justify-content-center mb-2">
                <img class="logo" src="/img/logo.png" alt="">
            </div>
            <div class="inner-container">
                <img :src="'/img/'+img+'.jpg'" alt="">
                <p class="question">{{question}}</p>
                <div class="flex justify-content-center mb-2">                
                    <input type="text" @keyup.enter="checkIfAnswerIsCorrect()" v-model="input">
                </div>
                <div class="flex justify-content-center">                
                    <button class="btn" @click="checkIfAnswerIsCorrect()">Let's See</button>
                </div>
                <div class="flex justify-content-between stats">
                    <div>
                        {{ correctAnswer }} / {{ wrongAnswer }} 
                    </div>
                    <div>
                        {{ currentQuestion }} / {{ totalQuestions }} 
                    </div>
                </div>
            </div>            
        </div>

    </div>
</template>
<script>
import axios from 'axios'
export default {
    data(){
        return {
            answer: null,
            input: null,
            questions: null,
            question: '',
            img: '',
            totalQuestions: 0,
            currentQuestion: 0,
            correctAnswer: 0,
            wrongAnswer: 0

        }
    },
    methods:{
        getQuestions(){
            axios.get('api/get-questions').then(r => {
                this.questions = r.data
                this.totalQuestions = r.data.length                
                this.getRandomQuestion()
            })
        },
        calculateRandomValue(length){
            return Math.floor(Math.random() * length)
        },
        getRandomQuestion(){
            // increment current Question value
            this.currentQuestion++
            // Selecting Random Question
            const questionPair = this.questions[this.calculateRandomValue(this.questions.length)]            
            
            // Removing Question from questions array
            this.questions.splice(questionPair, 1)
            

            // selecting random value from a Question pair and assigning to a question variable
            const question = Object.values(questionPair)[this.calculateRandomValue(Object.keys(questionPair).length)]
            this.question = question

            // Assigning img to a value
            this.img = questionPair.en.replace(' ', '_')
            // removing random value and assigning left out property to answer variable
            delete questionPair[Object.keys(questionPair).find(key => questionPair[key] === question)]
            this.answer = Object.values(questionPair)[0]
        },
        checkIfAnswerIsCorrect(){
            if(this.input == this.answer){
                this.correctAnswer++
                this.getRandomQuestion()
                this.input = ''
                // not best solution...
                if(this.questions.length = 0){
                    location.reload();
                }
            }else{
             this.wrongAnswer++   
            }
        }
    },
    mounted(){
        this.getQuestions();
    }
}
</script>