<template>

    <form id="shortenForm" v-on:submit.prevent="submit">
        <input type="url" v-model="url" class="form-control mb-3" placeholder="What URL do you want shortened?" required autocomplete="off">
        
        <div v-if="responseLength" class="mb-4">

            <div style="display:flex;" v-if="'short_url' in response">
                <input id="shorturl" class="form-control" v-bind:value="response.short_url" readonly>
                <button type="button" class="btn btn-dark clipboardBtn" data-clipboard-target="#shorturl">Copy</button>
            </div>

            <h3 class="h3 font-weight-normal" v-if="'error_msg' in response">{{ response.error_msg }}</h3>
            
        </div>
        
        <button type="submit" class="btn btn-lg btn-dark btn-block">Go for it!</button>
    </form>

</template>

<script>
    export default {
        data() {
            return {
                response: {},
                url: ''
            }
        },
        computed: {
            responseLength: function () {
                return Object.keys(this.response).length;
            }
        },
        methods: {
            submit: function () {
                if ( !document.getElementById('shortenForm').checkValidity() ) 
                    return;

                axios.post('/create_url', {
                    url: this.url
                })
                .then((response) => {
                    this.response = response.data;
                });
            }
        },
        mounted() {
            new ClipboardJS('.clipboardBtn');
        }
    }
</script>