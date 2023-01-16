<template>
    <div class="navbar">
        <router-link :to="{name:'Users'}">Пользователи</router-link>
        <router-link :to="{name:'Report'}">Отчет</router-link>
    </div>

    <main class="container">
        <router-view></router-view>
    </main>
</template>
