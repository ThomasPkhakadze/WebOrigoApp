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
                    <input type="text" v-model="input">
                </div>
                <div class="flex justify-content-center">                
                    <button class="btn" @click="checkIfAnswerIsCorrect()" @enter="checkIfAnswerIsCorrect()">Let's See</button>
                </div>
                <div class="flex justify-content-between">
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
<style>
    *{
        margin: 0;
    }
    .btn{
        background-color: #FF6700;
        border-radius: 0.2em;
        border: 0em;
        padding: 0.5em 2em;
        color: white;
    }
    input{
        box-shadow: 0.1em 0.01em 1em #FF6700;
        border-color: unset;
        border-radius: 0.1em;
        width: 100%;
    }
    .mb-2{
        margin-bottom: 1em;
    }
    .inner-container{
        background: #fff;
        padding: 3em 9em;
        border-radius: 1em;
    }
    .flex{
        display: flex;
    }
    .container{
        padding: 2em;
        background: #FF6700;
    }
    .justify-content-center{
        justify-content: center;
    }
    .justify-content-between{
        justify-content: space-between;        
    }
    .logo{
        margin-bottom: 2em;
    }
    .inner-container > img{
        width: 30em;
        border-radius: 0.7em;
    }
    .question{
        margin-bottom: 0.7em;
        font-size: 1.4em;
        font-weight: 700;
        text-align: center;
    }
</style>
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