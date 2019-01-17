<template>
    <div>
       
            <div class="container sm:max-width mt-5 mx-auto p-3 ">

                <div class="block lg:flex md:flex mb-4 front-featured first">


                    <div class="w-full lg:w-1/3  m:w-1/3 md:p-2 lg:p-2">
                        <div class="max-w-sm overflow-hidden">
                            <div class="max-w-sm overflow-hidden">
                            <template v-if="first.thumbnail">
                                <img class="w-full block" :src="`${basePublicUrl}images/${first.thumbnail.small}`" alt="Sunset in the mountains">
                            </template>
                            </div>
                            <div class="px-3 py-4">
                                <div class="font-bold text-base mb-2"><a class="text-grey-darkest no-underline hover:underline hover:text-black" :href="`${basePublicUrl}@${first.author.username}/${first.slug}`">{{first.title}}</a></div>
                                <p class="text-grey-darker text-xs">
                                    {{first.body}}
                                </p>
                            </div>
                            <div class="px-3 mb-5">
                                <p v-if="first.author" class="text-grey-darkest text-xs "><a href="" class="no-underline text-grey-darkest hover:underline">{{first.author.name}} </a>

                                <template v-if="first.tags">
                                    in <a href="" class="no-underline text-grey-darkest hover:underline" v-for="tag in first.tags">{{tag.name}}</a>
                                </template>
                                
                                </p>

                            </div>
                        </div>
                    </div>
                    <!--front-featured-first-->


                    <div class="w-full lg:w-1/3  m:w-1/3  md:p-2 lg:p-2 front-featureds inbetween">

                        <div class="flex mb-4 inbetween-row" v-for="featured in three">
                            <template v-if="featured.thumbnail" >
                                <div class="w-1/4 bg-cover" :style="{ 'background-image': 'url(' + basePublicUrl+'images/'+featured.thumbnail.small + ')' }"></div>
                            </template>
                            <div class="w-1/1 p-2">
                                <div class="text-black font-semibold text-sm mb-2"><a class="text-grey-darkest no-underline hover:underline hover:text-black" :href="`${basePublicUrl}@${featured.author.username}/${featured.slug}`">{{featured.title}}</a></div>
                                <p v-if="featured.author" class="text-grey-darkest text-xs "><a href="" class="no-underline text-grey-darkest hover:underline">{{featured.author.name}} </a>

                                <template v-if="featured.tags">
                                    in <a href="" class="no-underline text-grey-darkest hover:underline" v-for="tag in featured.tags">{{tag.name}}</a>
                                </template>
                                
                                </p>
                            </div>
                        </div>
                        <!--inbateen-row-->


                    </div>
                    <!--front-featureds-->

                    <div class="w-full lg:w-1/3  m:w-1/3 md:p-2 lg:p-2">
                        <div class="max-w-sm overflow-hidden">
                            <div class="max-w-sm overflow-hidden">
                            <template v-if="last.thumbnail">
                                <img class="w-full block" :src="`${basePublicUrl}images/${last.thumbnail.small}`" alt="Sunset in the mountains">
                            </template>
                            </div>
                            <div class="px-3 py-4">
                                <div class="font-bold text-base mb-2"><a class="text-grey-darkest no-underline hover:underline hover:text-black" :href="`${basePublicUrl}@${last.author.username}/${last.slug}`">{{last.title}}</a></div>
                                <p class="text-grey-darker text-xs">
                                    {{last.body}}
                                </p>
                            </div>
                            <div class="px-3 mb-5">
                                <p v-if="last.author" class="text-grey-darkest text-xs "><a href="" class="no-underline text-grey-darkest hover:underline">{{last.author.name}} </a>

                                <template v-if="last.tags">
                                    in <a href="" class="no-underline text-grey-darkest hover:underline" v-for="tag in last.tags">{{tag.name}}</a>
                                </template>
                                
                                </p>

                            </div>
                        </div>
                    </div>
                    <!--front-featureds-last-->
                </div>
                <!--flexbox-->

            </div>
            <!--container-->
        

    </div>
</template>

<script>
import first from 'lodash/first';
import last from 'lodash/last';
import pullAt from 'lodash/pullAt';
export default {
    data () {
        return {
            first: {},
            last: {},
            three: {},
            featureds: {},
            basePublicUrl: Laravel.basePublicUrl,
        }
    },
    methods: {
        getFeaturedArticles () {
            axios.get(`/api/featured`)
                .then(response => {
                    this.featureds = response.data.articles
                    this.first = _.first(response.data.articles, 0);
                    this.last = _.last(response.data.articles, 4);
                    this.three = _.pullAt(response.data.articles, [1, 2, 3]);
            })
        }
    },
    mounted () {
        this.getFeaturedArticles()
    }

}
</script>