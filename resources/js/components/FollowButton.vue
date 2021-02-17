<template>
    <div>
        <button @click='toggleFollow' :class='btnClass()'><span v-html='flwText()'></span></button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                status: this.follows == 1
            }
        },

        props: ['id', 'follows'],

        methods: {
            toggleFollow() {
                axios.post(`/follow/${this.id}`)
                    .then(resp => this.status = resp.data == 1)
            },

            btnClass() {
                return !this.status ? this.followClass : this.unfollowClass
            },

            flwText() {
                return !this.status ? this.followText : this.unfollowText
            }
        },

        computed: {
            followClass() {
                return 'ml-4 btn btn-primary h-50'
            },
            unfollowClass() {
                return 'ml-4 btn btn-secondary h-50'
            },
            followText() {
                return 'Follow'
            },
            unfollowText() {
                return 'Unfollow'
            }
        }
    }
</script>
