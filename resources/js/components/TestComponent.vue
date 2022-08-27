<template>
    <div class="container">
        <div>
            <img :src="'/img/'+img+'.jpg'" alt="">
            <p>{{question}}</p>
        </div>

    </div>
</template>
<style>
    .container{
        display: flex;
        justify-content: center;
        background: #FF6700;
    }
    img{
        width:400px;
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
            img: ''
        }
    },
    methods:{
        getQuestions(){
            axios.get('api/get-questions').then(r => {
                this.questions = r.data                
                this.getRandomQuestion()
            })
        },
        calculateRandomValue(length){
            return Math.floor(Math.random() * length)
        },
        getRandomQuestion(){
            // Selecting Random Question
            const questionPair = this.questions[this.calculateRandomValue(this.questions.length)]            
            
            // Removing Question from questions array
            this.questions.splice(questionPair, 1)
            

            // selecting random value from a Question pair and assigning to a question variable
            const question = Object.values(questionPair)[this.calculateRandomValue(Object.keys(questionPair).length)]
            this.question = question

            // Assigning img to a value
            this.img = questionPair.en
            // removing random value and assigning left out property to answer variable
            delete questionPair[Object.keys(questionPair).find(key => questionPair[key] === question)]
            this.answer = Object.values(questionPair)[0]
        },
        checkIfAnswerIsCorrect(){
            if(this.input == this.answer){
                this.getRandomQuestion()
            }
        }
    },
    mounted(){
        this.getQuestions();
    }
}
</script>