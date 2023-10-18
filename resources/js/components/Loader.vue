<template>
    <div class="vl-parent">
    <loading v-model:active="isLoading"
                 :is-full-page="fullPage"/>
    </div>
    </template>


    <script>
        import Loading from 'vue-loading-overlay';
        import 'vue-loading-overlay/dist/css/index.css';
        import { nextTick } from 'vue';

        export default {
            data() {
                return {
                    isLoading: false,
                    fullPage: true
                }
            },
            components: {
                Loading
            },
            mounted() {
                this.doAjax();
            }
            ,
            methods: {
                doAjax() {
                    this.isLoading = true;
                        nextTick()
                            .then(() => {
                            // The DOM has been updated
                            this.isLoading = false;
                        });
                },
                onCancel() {
                    console.log('User cancelled the loader.')
                }
            }

        }
    </script>
