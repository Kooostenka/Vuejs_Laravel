<template>
    <div class="checkbox-slider">
        <input type="checkbox" v-model="checked" @change="onChange" id="checkbox">
    </div>
</template>

<script>
    export default {
        props: {
            status: '',
            id: '',
        },

        data() {
            return {
                checked: (this.status == 1),
            }
        },

        methods: {
            onChange(){
                let data = new FormData();
                data.append('status', (this.checked==true)?1:0);
                data.append('_method', 'PATCH');

                axios.post('/api/users/'+this.id, data)
                    .catch((error)=>{
                        console.log(error)
                    })
                this.$emit('input', (this.checked == 1));
            },
        }
    }
</script>
