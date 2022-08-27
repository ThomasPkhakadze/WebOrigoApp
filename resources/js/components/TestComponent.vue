<template>
    <div>
        
    </div>
</template>
<style>
    div{
        background: #FF6700;
    }
</style>
<script>
import axios from 'axios'
export default {
    data(){
        return {
            answer: null,
            input: null
        }
    },
    methods:{
        getQuestions(){
            axios.get('api/get-questions').then(r => console.log(r))
        }
    },
    mounted(){
        this.getQuestions();
    }
}
</script>