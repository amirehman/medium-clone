<template>
    <div>
        <div v-if="success != false" class="text-center w-3/4 absolute pt-4">
            <div class="p-4 bg-green-Dark items-center text-indigo-lightest leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="font-semibold mr-2 text-left flex-auto">{{success}}</span>
                <span class="inline-block w-4 h-4 text-xs cursor-pointer rounded-full bg-red text-white" @click="closeMessage">x</span>
            </div>
        </div>
        <form @submit.prevent="submitForm" >
            <div class="table w-full lg:w-3/4 p-4">
                <div class="table-row p-5">
                    <div class="table-cell p-3">
                        <label class="block text-grey-darkest text-sm font-bold" for="title">
                                Title
                            </label>
                    </div>
                    <!--table-cell-->
                    <div class="table-cell p-3">
                        <input class="bg-transparent border w-full py-2 px-3 text-grey-darkest focus:outline-none"  v-model="article.title" type="text" placeholder="Article title">
                        <p class="text-xs text-red mt-1" v-if="errors.title">{{errors.title[0]}}</p>
                    </div>
                    <!--table-cell-->
                </div>
                <!--table-row-->
                <div class="table-row p-5">
                    <div class="table-cell p-3 align-top">
                        <label class="block text-grey-darkest text-sm font-bold" for="detail">
                            Detail
                        </label>
                    </div>
                    <!--table-cell-->
                    <div class="table-cell p-3">
                        <textarea rows="10" class="bg-transparent border w-full py-2 px-3 text-grey-darkest focus:outline-none" v-model="article.body" name="body"  type="detail" placeholder="Article Detail"></textarea>
                        <p class="text-xs text-red mt-1" v-if="errors.body">{{errors.body[0]}}</p>
                    </div>
                    <!--table-cell-->
                </div>
                <!--table-row-->
                <div class="table-row p-5">
                    <div class="table-cell p-3 align-top">
                        <label class="block text-grey-darkest text-sm font-bold" for="thumbnail">
                                Current Images
                            </label>
                    </div>
                    <!--table-cell-->
                    <div class="table-cell p-3">
                        <div class="w-32 m-1 inline-block relative" v-for="(thumb, index) in article.thumbnails">
                            <span class="text-xs p-1 bg-red-dark hover:bg-red-darker text-white absolute pin-t pin-r cursor-pointer" @click="removeImage(index, thumb.id)">Remove</span>
                            <img class="w-full" :src="`${basePublicUrl}images/${thumb.small}`" alt="Sunset in the mountains">
                        </div>
                    </div>
                    <!--table-cell-->
                </div>
                <!--table-row-->
                <div class="table-row p-5">
                    <div class="table-cell p-3 align-top">
                        <label class="block text-grey-darkest text-sm font-bold" for="thumbnail">
                                Images
                            </label>
                    </div>
                    <!--table-cell-->
                    <div class="table-cell p-3">
                        <input type="file" id="files" ref="files" multiple @change="handleFilesUpload" class="bg-transparent border w-full py-2 px-3 text-grey-darkest focus:outline-none"/>                        
                        <p class="text-xs text-grey-dark">If you choose multiple photos it will apear as slider on article page</p>
                    </div>
                    <!--table-cell-->
                </div>
                <!--table-row-->
                <div class="table-row p-5">
                    <div class="table-cell p-3 align-top">
                        <label class="block text-grey-darkest text-sm font-bold">
                                Tags
                            </label>
                    </div>
                    <!--table-cell-->
                    <div class="table-cell p-3">
                        <label  v-for="(tag, index) in tags" :class="{'bg-grey-dark text-white border-transparent':selectedTags.includes(tag.id)}"  class="cursor-pointer hover:bg-grey-dark hover:text-white hover:border-transparent mr-2 mb-2 text-sm text-grey-dark border p-2 inline-block">
                            <input type="checkbox" :value="tag.id" v-model="selectedTags" class="hidden">  {{tag.name}} 
                        </label>
                        <p class="text-xs text-red mt-1" v-if="errors.tags">{{errors.tags[0]}}</p>
                    </div>
                    <!--table-cell-->
                </div>
                <div class="table-row p-5">
                    <div class="table-cell p-3 align-top">
                        <label class="block text-grey-darkest text-sm font-bold">
                                Status
                            </label>
                    </div>
                    <!--table-cell-->
                    <div class="table-cell p-3">
                        <input type="radio" id="one" value="1" v-model="article.status">
                        <label for="one">Active</label>
                        <input type="radio" id="zero" value="0" v-model="article.status">
                        <label for="zero">Draft</label>
                    </div>
                    <!--table-cell-->
                </div>
                <!--table-row-->
                <div class="table-row p-5">
                    <div class="table-cell p-3">
                    </div>
                    <div class="table-cell p-3">
                        <input type="submit" name="submitarticle" :class="{'hidden': isSubmitted}" class="ld-over-inverse bg-transparent hover:bg-grey-dark hover:text-white cursor-pointer border w-full py-2 px-3 text-grey-darkest focus:outline-none">
                        <div :class="{'lds-facebook': isSubmitted}"><div></div><div></div><div></div></div>
                    </div>
                    <!--table-cell-->
                </div>
                <!--table-row-->
            </div>
            <!--table-->
        </form>
    </div>
</template>
<script>
    export default {
        props: ['aid'],
        data () {
            return {
                files: "",
                article: {
                    title: "",
                    body: "",
                },
                thumbnails: [],
                selectedTags: [],
                tags: [],
                errors: {},
                isSubmitted: false,
                baseUrl: Laravel.baseUrl,
                basePublicUrl: Laravel.basePublicUrl,
                success: false

            }
        },
        mounted() {
            this.getTags()
            this.getArticle()
        },
        methods: {
            closeMessage () {
                this.success = false;
            },
            removeImage (index, id) {
                axios.delete(`/manage/articles/${this.aid}/thumbnails/${id}`)
                .then((response) => {
                    this.article.thumbnails.splice(index, 1);
                    this.success = "Image Deleted Successfully!";
                })
            },
            getTags () {
                axios.get(`/manage/tags`)
                    .then(response => {
                        this.tags = response.data.tags
                });
            },
            getArticle () {
                axios.get(`/api/articles/${this.aid}`)
                    .then(response => {
                        this.article = response.data.article[0]
                        this.selectedTags = response.data.article[0].tags.map(s => s.id)
                        
                });
            },
           handleFilesUpload(e) {
                        var files = e.target.files; 
                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];
                            var fileReader = new FileReader();
                            fileReader.onload = (event) => {
                                this.thumbnails.push(event.target.result)
                            }
                            fileReader.readAsDataURL(file);
                        }
            },
           submitForm(){
                this.isSubmitted = true;
                axios.put(`/manage/articles/${this.aid}`, {
                        title: this.article.title,
                        body: this.article.body,
                        status: this.article.status,
                        thumbnails: this.thumbnails,
                        tags: this.selectedTags
                    })
                    .then(response => {
                        this.isSubmitted = false
                        this.getArticle();
                        this.thumbnails = "";
                        this.success = "Article Updated!";
                        this.errors = "";
                    }).catch((error) => {
                        this.isSubmitted = false;
                        this.errors = error.response.data.errors
                    });
            },
        }

    }
</script>

<style>
.lds-facebook {
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
}
.lds-facebook div {
  display: inline-block;
  position: absolute;
  left: 6px;
  width: 13px;
  background: grey;
  animation: lds-facebook 0.6s cubic-bezier(0, 0.5, 0.5, 1) infinite;
}
.lds-facebook div:nth-child(1) {
  left: 6px;
  animation-delay: -0.24s;
}
.lds-facebook div:nth-child(2) {
  left: 26px;
  animation-delay: -0.12s;
}
.lds-facebook div:nth-child(3) {
  left: 45px;
  animation-delay: 0;
}
@keyframes lds-facebook {
  0% {
    top: 6px;
    height: 51px;
  }
  50%, 100% {
    top: 19px;
    height: 26px;
  }
}

</style>