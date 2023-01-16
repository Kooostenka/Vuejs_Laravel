<template>
    <div class="popup_wrapper" ref="popup_wrapper">

        <form @submit.prevent="submit">
            <input class="input" type="text" name="name" placeholder="ФИО" v-model="fields.name"/>
            <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>

            <input class="input" type="text" name="email" placeholder="Email" v-model="fields.email"/>
            <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>

            <input class="input" type="password" name="password" placeholder="пароль" v-model="fields.password"/>
            <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>

            <input class="input" type="password" name="password_confirmation" placeholder="Подтверждение пароля" v-model="fields.password_confirmation"/>
            <span v-if="errors.password_confirmation" class="error">{{ errors.password_confirmation[0] }}</span>

            <button class="input" type="submit">Зарегистрировать</button>
            <button class="input" @click="closePopup">Отменить</button>
        </form>

    </div>
</template>

<script>
    export default {
        name: "register-popup",
        data(){
            return{
                fields:{},
                errors:{}
            }
        },

        methods:{
            submit(){
                axios.post('/api/register', this.fields).then(()=>{
                    this.closePopup();
                    this.$emit('getAllUsers')
                }).catch((error)=>{
                    this.errors=error.response.data.errors
                })
            },

            closePopup() {
                this.$emit('closePopup')
            }
        },

        mounted() {
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
