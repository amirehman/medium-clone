<template>
    <div>
        <nav class="container mx-auto">
            <ul class="list-reset md:flex-grow lg:flex  justify-between">
                <li class="mr-3" v-for="tag in tags">
                    <a class="inline-block no-underline px-3 text-grey-dark hover:text-grey-darkest text-xs font-medium uppercase" :href="`${basePublicUrl}topic/${tag.slug}`">{{tag.name}}</a>
                </li>
            </ul>
            <!--navbar-list-->
        </nav>
        <!--navbar-->
    </div>
</template>

<script>
export default {
    data () {
        return {
            tags: {},
            basePublicUrl: Laravel.basePublicUrl
        }
    },
    methods: {
        getTags () {
            axios.get(`/api/tags`)
                .then(response => {
                    this.tags = response.data.tags
            });
        },
    },
    mounted () {
        this.getTags()
    }

}
</script>