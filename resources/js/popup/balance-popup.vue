<template>
    <div class="popup_wrapper" ref="popup_wrapper">

        <form @submit.prevent="submit">

            <input class="input" type="text" name="sum" placeholder="Сумма" v-model="fields.sum"/>
            <span v-if="errors.sum" class="error">{{ errors.sum[0] }}</span>

            <label for="users"><span>Выберите получателя:</span></label>
            <select class="input" v-model="fields.user_id" id="users">
                <option disabled value="">Выбрать...</option>
                <option
                    :value="user.id"
                    v-for="user in users"
                    :key="user.id">{{user.email}}
                </option>
            </select>
            <span v-if="errors.user_id" class="error">{{ errors.user_id[0] }}</span>


            <button class="input" type="submit">Пополнить</button>
            <button class="input" @click="closePopup">Отменить</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'balance-popup',
        data(){
            return {
                fields:{
                    'user_id':'',
                },
                errors: {},
                users: []
            }
        },

        methods: {
            submit(){
                axios.post('/api/transactions', this.fields)
                    .then(()=>{
                        this.fields = {};
                        this.fields.user_id ='';
                        this.sum ='';
                        this.errors = {};
                        this.$emit('getAllUsers')
                        this.closePopup()
                    })
                    .catch((error)=>{
                        this.errors=error.response.data.errors
                    })
            },
            closePopup() {
                this.$emit('closePopup')
            }
        },

        mounted() {
            axios.get("/api/users/active")
                .then((response)=>(this.users = response.data.users))
                .catch((error)=>{
                    console.log(error)
                })

            let vm = this;
            document.addEventListener('click', function(item){
                if(item.target == vm.$refs['popup_wrapper']){
                    vm.closePopup()
                }
            })
        }
    }
</script>

<style scoped>

</style>

