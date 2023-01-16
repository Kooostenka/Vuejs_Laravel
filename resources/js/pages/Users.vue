<template>
    <h1>Пользователи</h1>
    <button class="btn-2" @click="showRegisterPopup">
        Регистрация
    </button>

    <register-popup
        v-if="isRegisterPopupVisible"
        @closePopup="closeRegisterPopup"
        @getAllUsers="getAllUsers"
    />

    <button class="btn-2" @click="showBalancePopup">
        Пополнение баланса
    </button>

    <balance-popup
        v-if="isBalancePopupVisible"
        @closePopup="closeBalancePopup"
        @getAllUsers="getAllUsers"
    />

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>ФИО</th>
            <th>Баланс</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>
        <tr class="item" v-for="user in users" :key="user.id">
            <td>{{user.id}}</td>
            <td>{{user.email}}</td>
            <td>{{user.name}}</td>
            <td>{{user.balance}}</td>
            <td>
                <switch-button :status="user.status" :id="user.id"></switch-button>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    import SwitchButton from '../button/Button.vue'
    import RegisterPopup from '../popup/register-popup.vue'
    import BalancePopup from '../popup/balance-popup.vue'

    export default {
        components: { SwitchButton, RegisterPopup, BalancePopup },
        data(){
            return {
                users: [],
                isRegisterPopupVisible: false,
                isBalancePopupVisible: false,
            }
        },

        methods: {
            showRegisterPopup(){
                this.isRegisterPopupVisible = true

            },
            closeRegisterPopup() {
                this.isRegisterPopupVisible = false
            },


            showBalancePopup(){
                this.isBalancePopupVisible = true

            },
            closeBalancePopup() {
                this.isBalancePopupVisible = false
            },



            getAllUsers() {
                axios.get("/api/users")
                    .then((response)=>{
                        this.users = response.data.users;
                    })
                    .catch((error)=>{
                        console.log(error)
                    })
            }
        },


        mounted() {
            this.getAllUsers()

        }
    }
</script>

