<template>
    <div>
 <div class="container mx-auto">
                <div class="block lg:flex md:flex mb-2 inbetween-row">
                    <div class="w-full lg:pr-5 md:pr-5 p-3">

                        <div class="section-header" v-if="page == 'home'">
                            <h1 class="mb-5 text-lg border-b border-grey-dark"><span class=" py-2 inline-block border-b border-grey-darkest">{{header}}</span></h1>
                        </div>

                        <div class="latest-articles-row">


                            <div class="latest-articles-single mb-8" v-for="article in articles">
                                <div class="flex mb-4">
                                    <div class="w-full">
                                        <div class="max-w-sm overflow-hidden">
                                            <div class="font-bold text-base mb-2"><a class="text-grey-darkest no-underline hover:underline hover:text-black" :href="`${basePublicUrl}@${article.author.username}/${article.slug}`">{{article.title}}</a></div>
                                            <p class="text-grey-darker text-xs">
                                                {{article.body}}
                                            </p>
                                            <div class="mt-4">
                                                <p class="text-black text-xs ">
                                                    <template v-if="article.author">
                                                        <a href="" class="no-underline font-semibold text-black hover:underline">{{article.author.name}} </a>
                                                    </template>
                                                    <template v-if="article.tags">
                                                    in <a href="" class="no-underline font-semibold text-grey-darkest hover:underline" v-for="tag in article.tags">{{tag.name}}</a> 
                                                    </template>

                                                </p>

                                                <p class="text-grey-darkest text-xs mt-1">{{article.date}} <span class="inline-block ml-1">-</span> <span class="inline-block ml-1">{{article.read}} read</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <template v-if="article.thumbnail">
                                        <div class="w-1/2 bg-grey">
                                            <div class="max-w-sm overflow-hidden">
                                                <img class="w-full block" :src="`${basePublicUrl}images/${article.thumbnail.small}`" alt="Sunset in the mountains">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <!--latest-article-single-->

                        </div>
                        <!--latest-article-row-->

                    </div>

                    <div class="lg:w-1/2 md:w-1/2 w-full p-3 md:pl-5 lg:pl-5">
                        <div class="papular-articles">


                            <div class="section-header">
                                <h1 class="mb-5 text-lg border-b border-grey-dark"><span class=" py-2 inline-block border-b border-grey-darkest">Popular on Medium</span></h1>
                            </div>

                            <div class="papular-articles-row">

                                <div class="papular-articles-single" v-for="(article, index) in featureds">
                                    <div class="flex mb-4">
                                        <div class="w-1/4 align-middle h-12 text-center font-bold text-xl">
                                            <span class="h-full block text-grey pt-4">{{index+1}}</span>
                                        </div>
                                        <div class="w-full p-3">

                                            <div class="max-w-sm overflow-hidden">
                                                <div class="font-bold text-base mb-2"><a class="text-grey-darkest no-underline hover:underline hover:text-black" :href="`${basePublicUrl}@${article.author.username}/${article.slug}`">{{article.title}}</a></div>
                                                <p class="text-grey-darker text-xs">
                                                    {{article.body}}
                                                </p>
                                                <div class="mt-4">
                                                    <p class="text-black text-xs ">

                                                    <template v-if="article.author">
                                                        <a href="" class="no-underline font-semibold text-black hover:underline">{{article.author.name}} </a> 
                                                    </template>
                                                    <template v-if="article.tags">
                                                    in <a href="" class="no-underline font-semibold text-grey-darkest hover:underline" v-for="tag in article.tags">{{tag.name}}</a> 
                                                    </template>
                                                    </p>
                                                    <p class="text-grey-darkest text-xs mt-1">{{article.date}} 
                                                        <span class="inline-block ml-1">-</span> 
                                                        <span class="inline-block ml-1">{{article.read}} read</span>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--papular-articles-single-->

                            </div>
                            <!--papular-articles-row-->
                        </div>
                        <!--papular-articles-->

                    </div>



                </div>
                <!--latest-articles-row-->
            </div>
            <!--container-->
    </div>
</template>

<script>
export default {
    props: ['header', 'page', 'tag'],
    data () {
        return {
            articles: {},
            featureds: {},
            basePublicUrl: Laravel.basePublicUrl,

        }
    },
    methods: {
        getArticles () {
            if(this.page == "topic"){
                axios.get(`/api/topic/${this.tag}`)
                    .then(response => {
                        this.articles = response.data.articles
                });
            }else{
                axios.get(`/api/articles`)
                    .then(response => {
                        this.articles = response.data.articles
                });
            }
        },
        getFeaturedArticles () {
            axios.get(`/api/featured`)
                .then(response => {
                    this.featureds = response.data.articles
            });
        },
    },
    mounted () {
        this.getArticles()
        this.getFeaturedArticles()
    }

}
</script>