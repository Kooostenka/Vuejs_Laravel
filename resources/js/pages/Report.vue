<template>
    <h1>Отчет по зачислениям</h1>

    <input class="input" type="text" placeholder="Введите ID пользователя" name="search" v-model="id">

<!--    <DatePicker v-model="range" mode="dateTime" is-range :is24hr="true" >-->
<!--        <template v-slot="{ inputValue, inputEvents }">-->
<!--            <div class="group">-->
<!--                <input type="text" id="start" v-model="inputValue.start" v-on="inputEvents.start">-->
<!--                <input type="text" id="end" v-model="inputValue.end" readonly>-->
<!--            </div>-->
<!--        </template>-->
<!--    </DatePicker>-->

    <table class="table">
        <thead>
        <tr>
            <th>Дата,время</th>
            <th>Пользователь</th>
            <th>Сумма</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        <tr class="item" v-for="transaction in transactions" :key="transaction.id">
            <td>{{transaction.created_at}}</td>
            <td>{{transaction.user.name}}</td>
            <td>{{transaction.sum}}</td>
            <td>
                <button class="btn-2 red" @click="deleteTransaction(transaction.id)">Отменить</button>
            </td>
        </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>Итого: {{total_amount}}</td>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    import { DatePicker } from "v-calendar";

    export default {
        components: {
            DatePicker
        },
        data(){
            return {
                transactions: [],
                id: '',
                total_amount: '',
                range: [],
            }
        },

        watch: {
            id() {
                axios.get('/api/transactions', {
                    params: {
                        search: this.id
                    }
                })
                    .then((response) => {
                        this.transactions = response.data.transactions;
                        this.total_amount = response.data.total_amount
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },

            range() {
                axios.get('/api/transactions', {
                    params: {
                        range: this.range
                    }
                })
                    .then((response) => {
                        this.transactions = response.data.transactions;
                        this.total_amount = response.data.total_amount
                    })
                    .catch((error) => {
                        console.log(error)
                    })

            }

        },

        mounted() {
            this.getAllTransactions()
        },

        methods: {

            getAllTransactions() {
                axios.get("/api/transactions")
                    .then((response)=>{
                        this.transactions = response.data.transactions;
                        this.total_amount = response.data.total_amount;
                    })
                    .catch((error)=>{
                        console.log(error)
                    })
            },


            deleteTransaction(id){

                if(confirm('Удалить?')){
                    let data = new FormData();
                    data.append('_method', 'DELETE');
                    axios.post('/api/transactions/'+id, data)
                        .then(response=>{
                            this.transactions = []
                            this.getAllTransactions()
                        })
                        .catch(error=> {
                            console.log(error)
                        })

                }
            }
        }
    }
</script>

<style scoped>
    .btn-2.red{
        background:red;
        margin: 0 auto;
    }
</style>
